<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chatrooms')->insert([
            'image'=>'default.png',
            'code'=>'11111',
            'groupName'=>'public',
            'days'=>'all days',
            'status'=>1,
        ]);
        DB::table('chatrooms')->insert([
            'image'=>'default.png',
            'code'=>'231231',
            'groupName'=>'group2',
            'days'=>'Saturday | Monday | Wednesday',
            'daysId'=>1,
            'status'=>1,
        ]);
        DB::table('chatrooms')->insert([
            'image'=>'default.png',
            'code'=>'123123',
            'groupName'=>'group3',
            'days'=>'Saturday | Monday | Wednesday',
            'daysId'=>null,
            'status'=>1,
        ]);
    }
}
