<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class StudentsTableSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $id = 1;
        foreach (range(1, 50) as $index) {
            DB::table('users')->insert([
                'email' => 'student' . $id . '@gmail.com',
                'password' => Hash::make('tlu@1234567890'),
                'role' => 'student',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $id++;
        }
        $idm = 1;
        foreach (range(1, 30) as $index) {
            DB::table('departments')->insert([
                'name' => 'Khoa ' . $idm,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $idm++;
        }
        $ia = 1;
        foreach (range(1, 50) as $index) {
            DB::table('students')->insert([
                'full_name' => 'student' . $ia,
                'day_of_birth' => $faker->dateTimeBetween('1990-01-01', '2006-12-31')->format('Y-m-d'),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'address' => $faker->randomElement(['HP', 'HN', 'HD', 'DN', 'HCM']),
                'phone' => '1234567890',
                'user_id' => $ia,
                'avatar' => 'avatars/avatar.png',
                'department_id' => $faker->numberBetween(1, 30),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $ia++;
        }


        $idm = 1;
        foreach (range(1, 30) as $index) {
            DB::table('subjects')->insert([
                'name' => 'Môn ' . $idm,
                'description' => $faker->randomElement(['Là bắt buộc', 'Tự chọn']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $idm++;
        }

    }
}
