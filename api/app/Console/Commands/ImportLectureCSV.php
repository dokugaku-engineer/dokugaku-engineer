<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

class ImportLectureCSV extends Command
{
    /**
     * alphaID の文字数
     *
     * @var int
     */
    private const PAD_UP = 5;

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
     *
     * @param  string $name
     * @return void
     */
    private function insert(string $name): void
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
     *
     * @param  string $name
     * @return array
     */
    private function getCsv(string $name): array
    {
        // CSVファイルをローカルに保存する
        $csvData = Storage::disk(env('FILE_DISK', 'public'))->get("lecture/${name}.csv");
        $local = Storage::disk('local');
        $local->put("./tmp/{$name}.csv", $csvData);

        $reader = Reader::createFromPath(base_path("storage/app/tmp/{$name}.csv"), 'r');
        $reader->setHeaderOffset(0);
        $records = $reader->getRecords();
        $data = [];
        foreach ($records as $record) {
            foreach ($record as $k => $v) {
                if ($v === '') {
                    $record[$k] = null;
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
     *
     * @param  array $csv
     * @return array
     */
    private function addSlugs(array $csv): array
    {
        // 削除されているかで列を分割
        $existingLectures = array_filter($csv, function ($row) {
            return $row['deleted_at'] === null;
        });
        $deletedLectures = array_filter($csv, function ($row) {
            return $row['deleted_at'] !== null;
        });

        // 削除されている列はslug, prev_lecture_slug, next_lecture_slugカラムをNULLにする
        $processedDeletedLectures = [];
        foreach ($deletedLectures as $lecture) {
            $lecture['slug'] = null;
            $lecture['prev_lecture_slug'] = null;
            $lecture['next_lecture_slug'] = null;
            $processedDeletedLectures[] = $lecture;
        }

        // 存在している列にslug, prev_lecture_slug, next_lecture_slugカラムを追加する
        // lesson_id, orderをキーとしてソートする
        $lessonIdSortKey = [];
        $orderSortKey = [];
        foreach ($existingLectures as $index => $lecture) {
            $lessonIdSortKey[$index] = $lecture['lesson_id'];
            $orderSortKey[$index] = $lecture['order'];
        }
        array_multisort($lessonIdSortKey, SORT_ASC, $orderSortKey, SORT_ASC, $existingLectures);

        // slugカラムを追加
        $lectures = [];
        foreach ($existingLectures as $lecture) {
            $lecture['slug'] = $this->alphaID($lecture['id'], self::PAD_UP);
            $lectures[] = $lecture;
        }

        // prev_lecture_slug、next_lecture_slugカラムを追加
        $processedLectures = [];
        foreach ($lectures as $index => $lecture) {
            $prevLectureSlug = null;
            $nextLectureSlug = null;

            if ($index > 0) {
                $prevLectureSlug = $lectures[$index - 1]['slug'];
            }

            if ($index < count($lectures) - 1) {
                $nextLectureSlug = $lectures[$index + 1]['slug'];
            }

            $lecture['prev_lecture_slug'] = $prevLectureSlug;
            $lecture['next_lecture_slug'] = $nextLectureSlug;
            $processedLectures[] = $lecture;
        }

        return array_merge($processedLectures, $processedDeletedLectures);
    }

    /**
     * slug用の短い英数字を数値から生成する
     *
     * 参考元
     * https://kvz.io/create-short-ids-with-php-like-youtube-or-tinyurl.html
     * https://q.hatena.ne.jp/1377468971
     *
     * 3文字以上のalphaIDが必要な場合は、下記を使用する
     * $padUp = 3 argument
     *
     * @param  int   $in
     * @param  mixed $padUp Number or boolean padds the result up to a specified length
     * @return mixed string or long
     */
    private function alphaID(int $in, $padUp = false)
    {
        // 数値をスクランブルする
        $in *= 0x1CA7BC5B; // 奇数その1の乗算
        $in &= 0x7FFFFFFF; // 下位31ビットだけ残して正の数であることを保つ
        $in = ($in >> 15) | (($in & 0x7FFF) << 16); // ビット上下逆転
        $in *= 0x6B5F13D3; // 奇数その2（奇数その1の逆数）の乗算
        $in &= 0x7FFFFFFF;
        $in = ($in >> 15) | (($in & 0x7FFF) << 16); // ビット上下逆転
        $in *= 0x1CA7BC5B; // 奇数その1の乗算
        $in &= 0x7FFFFFFF;

        // 数値から英数字のIDを生成する
        $out = '';
        $index = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $base = strlen($index);

        if (is_numeric($padUp)) {
            $padUp--;

            if ($padUp > 0) {
                $in += pow($base, $padUp);
            }
        }

        for ($t = ($in != 0 ? floor(log($in, $base)) : 0); $t >= 0; $t--) {
            $bcp = (float) bcpow((string) $base, (string) $t);
            $a = floor($in / $bcp) % $base;
            $out = $out . substr($index, $a, 1);
            $in = $in - ($a * $bcp);
        }

        return $out;
    }
}
