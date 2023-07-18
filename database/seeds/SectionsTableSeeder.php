<?php

use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert([
            'image'=>'english.png',
            'name' => 'English',
            'name_ar' => 'انكليزي',
            'translate'=>'Translate',
            'translate_ar'=>'ترجمة',
            'conversation'=>'Conversation',
            'conversation_ar'=>'محادثة',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sections')->insert([
            'image'=>'arabic.png',
            'name' => 'Arabic',
            'name_ar' => 'عربي',
            'translate'=>'Translate',
            'translate_ar'=>'ترجمة',
            'conversation'=>'Conversation',
            'conversation_ar'=>'محادثة',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sections')->insert([
            'image'=>'french.png',
            'name' => 'French',
            'name_ar' => 'فرنسي',
            'translate'=>'Translate',
            'translate_ar'=>'ترجمة',
            'conversation'=>'Conversation',
            'conversation_ar'=>'محادثة',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sections')->insert([
            'image'=>'german.png',
            'name' => 'German',
            'name_ar' => 'الماني',
            'translate'=>'Translate',
            'translate_ar'=>'ترجمة',
            'conversation'=>'Conversation',
            'conversation_ar'=>'محادثة',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sections')->insert([
            'image'=>'italian.png',
            'name' => 'Italian',
            'name_ar' => 'ايطالي',
            'translate'=>'Translate',
            'translate_ar'=>'ترجمة',
            'conversation'=>'Conversation',
            'conversation_ar'=>'محادثة',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sections')->insert([
            'image'=>'russian.png',
            'name' => 'Russian',
            'name_ar' => 'روسيا',
            'translate'=>'Translate',
            'translate_ar'=>'ترجمة',
            'conversation'=>'Conversation',
            'conversation_ar'=>'محادثة',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sections')->insert([
            'image'=>'spanish.png',
            'name' => 'Spanish',
            'name_ar' => 'اسباني',
            'translate'=>'Translate',
            'translate_ar'=>'ترجمة',
            'conversation'=>'Conversation',
            'conversation_ar'=>'محادثة',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
