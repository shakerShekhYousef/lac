<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            'name' => 'active',
            'name_ar' => 'فاعل',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('statuses')->insert([
            'name' => 'disactive',
            'name_ar' => 'متوقف',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('statuses')->insert([
            'name' => 'congealed',
            'name_ar' => 'مجمد',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('statuses')->insert([
            'name' => 'expired',
            'name_ar' => 'نقل الى الحجز',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('statuses')->insert([
            'name' => 'graduate',
            'name_ar' => 'متخرج',
            'created_at' => now(),
            'updated_at' => now()
        ]);


    }
}
