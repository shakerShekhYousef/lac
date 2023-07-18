<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('abouts')->insert([
           'content'=>'about',
           'content_ar'=>'حول',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
