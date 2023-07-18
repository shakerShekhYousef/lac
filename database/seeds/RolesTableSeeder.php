<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'superAdmin',
            'name_ar' => 'المدير العام',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('roles')->insert([
            'name' => 'admin',
            'name_ar' => 'مدير',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('roles')->insert([
            'name' => 'student',
            'name_ar' => 'طالب',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('roles')->insert([
            'name' => 'teacher',
            'name_ar' => 'استاذ',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('roles')->insert([
            'name' => 'marketing',
            'name_ar' => 'مدير التسويق',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
