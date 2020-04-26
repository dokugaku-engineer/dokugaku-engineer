<?php

// https://github.com/brendt/laravel-preload/blob/master/preload.php
// https://stitcher.io/blog/preloading-in-php-74

require_once __DIR__ . '/vendor/autoload.php';

class Preloader
{
    private $ignores = [];

    private static $count = 0;

    private $paths;

    private $fileMap;

    public function __construct(string ...$paths)
    {
        $this->paths = $paths;

        // ファイル名でクラスをautoloadできるよう、composerのclassmapを使う
        $classMap = require __DIR__ . '/vendor/composer/autoload_classmap.php';

        $this->fileMap = array_flip($classMap);
    }

    public function paths(string ...$paths): Preloader
    {
        $this->paths = array_merge(
            $this->paths,
            $paths
        );

        return $this;
    }

    public function ignore(string ...$names): Preloader
    {
        $this->ignores = array_merge(
            $this->ignores,
            $names
        );

        return $this;
    }

    public function load(): void
    {
        // 全ての登録されているパスをループして一つずつロードする
        foreach ($this->paths as $path) {
            $this->loadPath(rtrim($path, '/'));
        }

        $count = self::$count;

        echo "[Preloader] Preloaded {$count} classes" . PHP_EOL;
    }

    private function loadPath(string $path): void
    {
        // カレントパスがディレクトリだったらその中の全ファイルをロードする
        if (is_dir($path)) {
            $this->loadDir($path);

            return;
        }

        // そうでなければ一つのファイルだけロードする
        $this->loadFile($path);
    }

    private function loadDir(string $path): void
    {
        $handle = opendir($path);

        // カレントパスの全てのファイルとディレクトリをループし、一つずつロードする
        while ($file = readdir($handle)) {
            if (in_array($file, ['.', '..'])) {
                continue;
            }

            $this->loadPath("{$path}/{$file}");
        }

        closedir($handle);
    }

    private function loadFile(string $path): void
    {
        // composerのautoload機能によりクラス名の名前解決をする
        $class = $this->fileMap[$path] ?? null;

        if ($this->shouldIgnore($class)) {
            return;
        }

        // 最終的にパスをrequireし、依存関係もロードする
        require_once($path);

        self::$count++;
    }

    private function shouldIgnore(?string $name): bool
    {
        if ($name === null) {
            return true;
        }

        foreach ($this->ignores as $ignore) {
            if (strpos($name, $ignore) === 0) {
                return true;
            }
        }

        return false;
    }
}

(new Preloader())
    ->paths(__DIR__ . '/vendor/symfony/console/Terminal.php') // ロードに失敗するので事前にロードしておく
    ->paths(__DIR__ . '/vendor/laravel')
    ->ignore(
        \Illuminate\Filesystem\Cache::class,
        \Illuminate\Log\LogManager::class,
        \Illuminate\Http\Testing\File::class,
        \Illuminate\Http\UploadedFile::class,
        \Illuminate\Support\Carbon::class,
    )
    ->load();
