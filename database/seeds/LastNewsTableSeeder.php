<?php

use Illuminate\Database\Seeder;

class LastNewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('last_news')->insert([
            'image' => 'getlorem-library-to-generate-lorem-ipsum-text.png',
            'title' => 'test01',
            'title_ar' => 'تجربة 01',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ex risus, placerat nec fermentum ac, blandit nec lectus. Suspendisse massa nibh, lacinia id elit vitae, facilisis aliquet mi. Nulla est tellus, efficitur in tellus placerat, fringilla vulputate dolor. Praesent tempus porta lectus eu fermentum. Donec quis neque rutrum, fermentum nisl faucibus, laoreet magna. Etiam feugiat auctor felis quis congue. Proin id risus fermentum ligula consectetur luctus a quis neque. Sed eu ipsum vel quam faucibus ullamcorper. Nunc vehicula, massa id cursus interdum, neque tellus vulputate lectus, quis convallis arcu mauris id nibh.',
            'body_ar' => 'أبجد هوز حطي كلمن سعفص قرشت ثخذ ضظغ',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('last_news')->insert([
            'image' => 'lorem-ipsum.png',
            'title' => 'test02',
            'title_ar' => 'تجربة02',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ex risus, placerat nec fermentum ac, blandit nec lectus. Suspendisse massa nibh, lacinia id elit vitae, facilisis aliquet mi. Nulla est tellus, efficitur in tellus placerat, fringilla vulputate dolor. Praesent tempus porta lectus eu fermentum. Donec quis neque rutrum, fermentum nisl faucibus, laoreet magna. Etiam feugiat auctor felis quis congue. Proin id risus fermentum ligula consectetur luctus a quis neque. Sed eu ipsum vel quam faucibus ullamcorper. Nunc vehicula, massa id cursus interdum, neque tellus vulputate lectus, quis convallis arcu mauris id nibh.',
            'body_ar' => 'أبجد هوز حطي كلمن سعفص قرشت ثخذ ضظغ',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('last_news')->insert([
            'image' => 'lorem-ipsum1.jpg',
            'title' => 'test03',
            'title_ar' => 'تجربة03',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ex risus, placerat nec fermentum ac, blandit nec lectus. Suspendisse massa nibh, lacinia id elit vitae, facilisis aliquet mi. Nulla est tellus, efficitur in tellus placerat, fringilla vulputate dolor. Praesent tempus porta lectus eu fermentum. Donec quis neque rutrum, fermentum nisl faucibus, laoreet magna. Etiam feugiat auctor felis quis congue. Proin id risus fermentum ligula consectetur luctus a quis neque. Sed eu ipsum vel quam faucibus ullamcorper. Nunc vehicula, massa id cursus interdum, neque tellus vulputate lectus, quis convallis arcu mauris id nibh.',
            'body_ar' => 'أبجد هوز حطي كلمن سعفص قرشت ثخذ ضظغ',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('last_news')->insert([
            'image' => 'Lorem-Ipsum-alternatives.png',
            'title' => 'test04',
            'title_ar' => 'تجربة04',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ex risus, placerat nec fermentum ac, blandit nec lectus. Suspendisse massa nibh, lacinia id elit vitae, facilisis aliquet mi. Nulla est tellus, efficitur in tellus placerat, fringilla vulputate dolor. Praesent tempus porta lectus eu fermentum. Donec quis neque rutrum, fermentum nisl faucibus, laoreet magna. Etiam feugiat auctor felis quis congue. Proin id risus fermentum ligula consectetur luctus a quis neque. Sed eu ipsum vel quam faucibus ullamcorper. Nunc vehicula, massa id cursus interdum, neque tellus vulputate lectus, quis convallis arcu mauris id nibh.',
            'body_ar' => 'أبجد هوز حطي كلمن سعفص قرشت ثخذ ضظغ',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('last_news')->insert([
            'image' => 'unnamed.png',
            'title' => 'test05',
            'title_ar' => 'تجربة05',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ex risus, placerat nec fermentum ac, blandit nec lectus. Suspendisse massa nibh, lacinia id elit vitae, facilisis aliquet mi. Nulla est tellus, efficitur in tellus placerat, fringilla vulputate dolor. Praesent tempus porta lectus eu fermentum. Donec quis neque rutrum, fermentum nisl faucibus, laoreet magna. Etiam feugiat auctor felis quis congue. Proin id risus fermentum ligula consectetur luctus a quis neque. Sed eu ipsum vel quam faucibus ullamcorper. Nunc vehicula, massa id cursus interdum, neque tellus vulputate lectus, quis convallis arcu mauris id nibh.',
            'body_ar' => 'أبجد هوز حطي كلمن سعفص قرشت ثخذ ضظغ',
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
