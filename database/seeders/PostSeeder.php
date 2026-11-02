<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            [
                'title' => 'Belajar Laravel',
                'content' => 'Belajar dasar framework Laravel.',
                'author' => 'Amisha',
            ],
            [
                'title' => 'Mengenal Eloquent',
                'content' => 'Belajar menggunakan Eloquent ORM.',
                'author' => 'Amisha',
            ],
            [
                'title' => 'Memahami MVC',
                'content' => 'Memahami Model View Controller.',
                'author' => 'Amisha',
            ],
        ]);
    }
}