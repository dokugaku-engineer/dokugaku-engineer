<?php

use App\Models\Lecture;
use App\Models\TakingCourse;
use Illuminate\Database\Seeder;

class LecturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $lecture = factory(Lecture::class)->create();
        factory(TakingCourse::class)->create([
            'course_id' => $lecture->lesson->part->course_id,
        ]);
    }
}
