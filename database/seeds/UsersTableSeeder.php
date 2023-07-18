<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'superAdmin',
            'email' => 'superadmin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secretsuper'),
            'national_number'=>'0000',
            'code'=>'0000',
            'role_id'=>1,
            'status_id'=>1,
            'image'=>'default.png',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secretadmin'),
            'role_id'=>2,
            'status_id'=>1,
            'national_number'=>'1111',
            'code'=>'1111',
            'image'=>'default.png',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'student',
            'email' => 'user@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secretstudent'),
            'role_id'=>3,
            'status_id'=>1,
            'national_number'=>'2222',
            'code'=>'2222',
            'image'=>'default.png',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'teacher',
            'email' => 'teacher@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secretteacher'),
            'role_id'=>4,
            'status_id'=>1,
            'national_number'=>'333',
            'code'=>'3333',
            'image'=>'default.png',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'marketing',
            'email' => 'marketing@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secretmarketing'),
            'role_id'=>5,
            'status_id'=>1,
            'national_number'=>'4444',
            'code'=>'4444',
            'image'=>'default.png',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('user_groups')->insert([
            'user_id'=>1,
            'group_id'=>1,
            'is_active'=>1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('user_groups')->insert([
            'user_id'=>2,
            'group_id'=>1,
            'is_active'=>1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('user_groups')->insert([
            'user_id'=>3,
            'group_id'=>1,
            'is_active'=>1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('user_groups')->insert([
            'user_id'=>5,
            'group_id'=>1,
            'is_active'=>1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
