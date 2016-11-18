<?php

use Illuminate\Database\Seeder;

class ChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Chapter::class, 10000)->create()->each(function ($a) {

        });
    }
}
