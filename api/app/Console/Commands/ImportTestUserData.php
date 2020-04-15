<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\TakingCourse;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\LearningHistory;

class ImportTestUserData extends Command
{
    // 一度にINSERTするユーザー数
    const ONCE_INSERT_NUM = 100;
    // INSERTを行う回数
    const INSERT_LOOP_NUM = 100;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:test-user-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import test data of users';

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
        for ($i = 1; $i <= $this::INSERT_LOOP_NUM; $i++) {
            $users = $this->insertUsers();
            $this->insertTakingCourses($users);
            // 大量のINSERTを行うとメモリリークするので調整
            if ($i === 1) {
                $this->insertLearningHistories($users);
            }
        }
    }

    private function insertUsers()
    {
        if (User::all()->count() > 0) {
            $lastId = User::orderBy('id', 'desc')->first()->id;
        } else {
            $lastId = 0;
        }
        $users = [];
        for ($i = $lastId + 1; $i <= ($lastId + 1 + $this::ONCE_INSERT_NUM); $i++) {
            $user = [
                'id' => $i,
                'username' => (string) ($i * 100),
                'email' => "$i@example.com",
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ];
            array_push($users, $user);
        }
        DB::table("users")->insert($users);
        return $users;
    }

    private function insertTakingCourses($users)
    {
        if (TakingCourse::all()->count() > 0) {
            $lastId = TakingCourse::orderBy('id', 'desc')->first()->id;
        } else {
            $lastId = 0;
        }
        $takingCourses = [];
        foreach ($users as $index => $user) {
            $takingCourse = [
                'id' => $lastId + $index + 1,
                'user_id' => $user['id'],
                'course_id' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ];
            array_push($takingCourses, $takingCourse);
        }
        DB::table("taking_courses")->insert($takingCourses);
        return $takingCourses;
    }

    private function insertLearningHistories($users)
    {
        if (LearningHistory::all()->count() > 0) {
            $lastId = LearningHistory::orderBy('id', 'desc')->first()->id;
        } else {
            $lastId = 0;
        }
        $lectures = Lecture::all();
        $course = Course::first();
        $lectureNum = count($lectures);
        foreach ($users as $i => $user) {
            $learningHistories = [];
            foreach ($lectures as $index => $lecture) {
                $learningHistory = [
                    'id' => $lastId + $i * $lectureNum + $index + 1,
                    'user_id' => $user['id'],
                    'course_id' => $course->id,
                    'lecture_id' => $lecture->id,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ];
                array_push($learningHistories, $learningHistory);
            }
            DB::table("learning_histories")->insert($learningHistories);
        }
    }
}
