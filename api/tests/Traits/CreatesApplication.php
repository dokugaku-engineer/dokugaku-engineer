<?php

namespace Tests\Traits;

use App\Console\Kernel;
use Illuminate\Contracts\Console\Kernel as Artisan;
use Illuminate\Foundation\Application;

trait CreatesApplication
{
    /** @var Kernel */
    private $artisan;

    public function createApplication()
    {
        /** @var Application $app */
        $app = require __DIR__.'/../../bootstrap/app.php';

        $this->artisan = $app->make(Artisan::class);
        $this->artisan->bootstrap();

        return $app;
    }

    private function prepareForTests(): void
    {
        $this->artisan->call('migrate');
        $this->artisan->call('db:seed');
    }
}
