<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateDummyBlog extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogs = [
            [
                'title' => 'Laravel Product CRUD Tutorial',
                'content' => 'Step by Step Laravel Product CRUD Tutorial',
                "image"=>null,
            ],
            [
                'title' => 'Laravel Image Upload Example',
                'content' => 'Step by Step Laravel Image Upload Example',
                "image"=>null
            ],
            [
                'title' => 'Laravel File Upload Example',
                'content' => 'Step by Step Laravel File Upload Example',
                "image"=>null
            ],
            [
                'title' => 'Laravel Cron Job Example',
                'content' => 'Step by Step Laravel Cron Job Example',
                "image"=>null
            ],
            [
                'title' => 'Laravel Send Email Example',
                'content' => 'Step by Step Laravel Send Email Example',
                "image"=>null
            ],
            [
                'title' => 'Laravel CRUD with Image Upload',
                'content' => 'Step by Step Laravel CRUD with Image Upload',
                "image"=>null
            ],
            [
                'title' => 'Laravel Ajax CRUD with Image Upload',
                'content' => 'Step by Step Laravel Ajax CRUD with Image Upload',
                "image"=>null
            ],
            [
                'title' => 'Laravel Ajax CRUD with Image Upload',
                'content' => 'Step by Step Laravel Ajax CRUD with Image Upload',
                "image"=>null
            ]
        ];

        foreach ($blogs as $key => $value) {
            Blog::create([
                'title' => $value['title'],
                'content' => $value['content'],
            ]);
        }
    }
}
