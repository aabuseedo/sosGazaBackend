<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            AdminsTableSeeder::class,
            NotificationsTableSeeder::class,
            CoursesTableSeeder::class,
            LessonsTableSeeder::class,
            SosRequestsTableSeeder::class,
            LocationsTableSeeder::class,
            SmartAssistantTableSeeder::class,
            OtpCodesTableSeeder::class,
        ]);
    }
}
