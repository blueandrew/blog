<?php

namespace Database\Seeders;

use App\Models\Works;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($index = 0; $index < 5; $index++) {
            $works = new Works;
            $works->user_id = 1;
            $works->title = 'title'.$index;
            $works->url = "https://xxxx";
            $works->status = 1;
            $works->save();
        }
    }
}
