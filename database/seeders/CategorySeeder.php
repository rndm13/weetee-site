<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ["Critical Issue", "Bug", "Feature Request", "Question", "Other"];
        foreach ($categories as $category) {
            if (Category::where("title", $category) === null) {
                Category::factory()->create(["title" => $category]);
            }
        }
    }
}
