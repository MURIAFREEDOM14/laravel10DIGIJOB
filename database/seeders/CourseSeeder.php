<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('courses')->insert([
            [
                'nama'          => 'Laravel Master Class',
                'category_id'   => 1
            ],
            [
                'nama'          => 'Laravel for Beginners',
                'category_id'   => 1
            ],
            [
                'nama'          => 'CodeIgniter 4: Build a Complete Web Application from Scratch',
                'category_id'   => 1
            ],
            [
                'nama'          => 'The Modern JavaScript Bootcamp',
                'category_id'   => 2
            ],
            [
                'nama'          => 'JavaScript: The Advanced Concepts (2021)',
                'category_id'   => 2
            ],
            [
                'nama'          => 'Learning Alpine.JS',
                'category_id'   => 2
            ],
            [
                'nama'          => 'Start with TALL: Use Tailwind, Alpine, Laravel & Livewire',
                'category_id'   => 2
            ],
        ]);
    }
}
