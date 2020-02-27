<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

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
        var_dump(123);
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
    }

    /**
     * コースのCSVデータを取得する
     */
    private function getCsv($name)
    {
        $csvData = Storage::disk(env('FILE_DISK', 'local'))->get("lecture/${name}.csv");
        $csvLines = explode(PHP_EOL, $csvData);
        $csv = [];
        foreach ($csvLines as $line) {
            $csv[] = str_getcsv($line);
        }

        $data = [];
        $header = array_shift($csv);
        foreach ($csv as $row) {
            if (empty($row[0])) {
                continue;
            }

            $rowData = [];
            foreach ($row as $k => $v) {
                $rowData[$header[$k]] = $v;
                $rowData['created_at'] = Carbon::now()->toDateTimeString();
                $rowData['updated_at'] = Carbon::now()->toDateTimeString();
            }
            $data[] = $rowData;
        }
        return $data;
    }

    /**
     * CSVデータにslug, prev_lecture_slug, next_lecture_slugカラムを追加する
     */
    private function addSlugs($csv)
    {
        $lectures = [];

        # slugカラムを追加
        foreach ($csv as $row) {
            $row['slug'] = $this->alphaID($row['id'], self::PAD_UP);
            $lectures[] = $row;
        }

        $processedLecrures = [];

        # prev_lecture_slug、next_lecture_slugカラムを追加
        foreach ($lectures as $lecture) {
            $prev_lecture_slug = '';
            $next_lecture_slug = '';
            $prev_lecture_id = $lecture['id'] - 1;
            $next_lecture_id = $lecture['id'] + 1;

            if ($prev_lecture_id > 0) {
                $prev_lecture = array_filter($lectures, function ($item) use ($prev_lecture_id) {
                    return $item['id'] == $prev_lecture_id;
                })[$prev_lecture_id - 1];
                $prev_lecture_slug = $prev_lecture['slug'];
            }

            if ($next_lecture_id <= count($lectures)) {
                $next_lecture = array_filter($lectures, function ($item) use ($next_lecture_id) {
                    return $item['id'] == $next_lecture_id;
                })[$next_lecture_id - 1];
                $next_lecture_slug = $next_lecture['slug'];
            }

            $lecture['prev_lecture_slug'] = $prev_lecture_slug;
            $lecture['next_lecture_slug'] = $next_lecture_slug;
            $processedLecrures[] = $lecture;
        }

        return $processedLecrures;
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
