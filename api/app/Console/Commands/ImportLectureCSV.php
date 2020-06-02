<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;
use League\Csv\Reader;

class ImportLectureCSV extends Command
{
    const PAD_UP = 5;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:lecture-csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import csv data of course, part, lesson and lecture';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tables = ['course', 'part', 'lesson', 'lecture'];
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        foreach ($tables as $table) {
            $this->insert($table);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * CSVデータを保存する
     */
    private function insert($name)
    {
        DB::table("${name}s_olds")->truncate();
        $csv = $this->getCsv($name);

        if ($name == 'lecture') {
            $csv = $this->addSlugs($csv);
        }

        // TODO: データのバリデーションを行う
        DB::table("${name}s_olds")->insert($csv);
        Schema::rename("${name}s", "${name}s_tmp");
        Schema::rename("${name}s_olds", "${name}s");
        Schema::rename("${name}s_tmp", "${name}s_olds");

        Storage::deleteDirectory('tmp');
    }

    /**
     * コースのCSVデータを取得する
     */
    private function getCsv($name)
    {
        // CSVファイルをローカルに保存する
        $csv_data = Storage::disk(env('FILE_DISK', 'public'))->get("lecture/${name}.csv");
        $local = Storage::disk('local');
        $local->put("./tmp/{$name}.csv", $csv_data);

        $reader = Reader::createFromPath(base_path("storage/app/tmp/{$name}.csv", 'r'));
        $reader->setHeaderOffset(0);
        $records = $reader->getRecords();
        $data = [];
        foreach ($records as $record) {
            foreach ($record as $k => $v) {
                if ($v === '') {
                    $record[$k] = NULL;
                }
            }

            $record['created_at'] = Carbon::now()->toDateTimeString();
            $record['updated_at'] = Carbon::now()->toDateTimeString();
            $data[] = $record;
        }
        return $data;
    }

    /**
     * CSVデータにslug, prev_lecture_slug, next_lecture_slugカラムを追加する
     */
    private function addSlugs($csv)
    {
        # 削除されているかで列を分割
        $existing_lectures = array_filter($csv, function ($row) {
            return $row['deleted_at'] === NULL;
        });
        $deleted_lectures = array_filter($csv, function ($row) {
            return $row['deleted_at'] !== NULL;
        });

        # 削除されている列はslug, prev_lecture_slug, next_lecture_slugカラムをNULLにする
        $processed_deleted_lectures = [];
        foreach ($deleted_lectures as $lecture) {
            $lecture['slug'] = NULL;
            $lecture['prev_lecture_slug'] = NULL;
            $lecture['next_lecture_slug'] = NULL;
            $processed_deleted_lectures[] = $lecture;
        }

        # 存在している列にslug, prev_lecture_slug, next_lecture_slugカラムを追加する
        # lesson_id, orderをキーとしてソートする
        $lesson_id_sort_key = [];
        $order_sort_key = [];
        foreach ($existing_lectures as $index => $lecture) {
            $lesson_id_sort_key[$index] = $lecture['lesson_id'];
            $order_sort_key[$index] = $lecture['order'];
        }
        array_multisort($lesson_id_sort_key, SORT_ASC, $order_sort_key, SORT_ASC, $existing_lectures);

        # slugカラムを追加
        $lectures = [];
        foreach ($existing_lectures as $lecture) {
            $lecture['slug'] = $this->alphaID($lecture['id'], self::PAD_UP);
            $lectures[] = $lecture;
        }

        # prev_lecture_slug、next_lecture_slugカラムを追加
        $processed_lectures = [];
        foreach ($lectures as $index => $lecture) {
            $prev_lecture_slug = NULL;
            $next_lecture_slug = NULL;

            if ($index > 0) {
                $prev_lecture_slug = $lectures[$index - 1]['slug'];
            }

            if ($index < count($lectures) - 1) {
                $next_lecture_slug = $lectures[$index + 1]['slug'];
            }

            $lecture['prev_lecture_slug'] = $prev_lecture_slug;
            $lecture['next_lecture_slug'] = $next_lecture_slug;
            $processed_lectures[] = $lecture;
        }

        return array_merge($processed_lectures, $processed_deleted_lectures);
    }

    /**
     * slug用の短い英数字を数値から生成する
     *
     * 参考元
     * https://kvz.io/create-short-ids-with-php-like-youtube-or-tinyurl.html
     * https://q.hatena.ne.jp/1377468971
     *
     * 3文字以上のalphaIDが必要な場合は、下記を使用する
     * $pad_up = 3 argument
     *
     * @param int $id
     * @param mixed $pad_up  Number or boolean padds the result up to a specified length
     *
     * @return mixed string or long
     */
    private function alphaID($in, $pad_up = false)
    {
        // 数値をスクランブルする
        $in *= 0x1ca7bc5b; // 奇数その1の乗算
        $in &= 0x7FFFFFFF; // 下位31ビットだけ残して正の数であることを保つ
        $in = ($in >> 15) | (($in & 0x7FFF) << 16); // ビット上下逆転
        $in *= 0x6b5f13d3; // 奇数その2（奇数その1の逆数）の乗算
        $in &= 0x7FFFFFFF;
        $in = ($in >> 15) | (($in & 0x7FFF) << 16); // ビット上下逆転
        $in *= 0x1ca7bc5b; // 奇数その1の乗算
        $in &= 0x7FFFFFFF;

        // 数値から英数字のIDを生成する
        $out = '';
        $index = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $base = strlen($index);

        if (is_numeric($pad_up)) {
            $pad_up--;

            if ($pad_up > 0) {
                $in += pow($base, $pad_up);
            }
        }

        for ($t = ($in != 0 ? floor(log($in, $base)) : 0); $t >= 0; $t--) {
            $bcp = bcpow($base, $t);
            $a = floor($in / $bcp) % $base;
            $out = $out . substr($index, $a, 1);
            $in = $in - ($a * $bcp);
        }

        return $out;
    }
}
