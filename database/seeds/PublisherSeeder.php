<?php

use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Publisher\Publisher::class, 10)->create()->each(function ($a) {

        });
    }
}
