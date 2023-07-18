<?php

use Illuminate\Database\Seeder;

class ProcedureTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('procedure_types')->insert([
            'name' => 'Turn off time',
            'name_ar' => 'ايقاف الدوام',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('procedure_types')->insert([
            'name' => 'Postponement of the exam',
            'name_ar' => 'تأجيل الامتحان',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('procedure_types')->insert([
            'name' => 'Justify the absence',
            'name_ar' => 'تبرير غياب',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('procedure_types')->insert([
            'name' => 'Retest',
            'name_ar' => 'إعادة الاختبار',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
