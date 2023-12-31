<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str; // 👈  Importami


class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {

            $Project = new Project();
            $Project->title = $faker->sentence(3);
            $Project->slug = Str::slug($Project->title, '-'); // 👈  Use me to generate a slug
            $Project->content = $faker->paragraphs(asText: true); 
            $Project->user_id = 1;
            $Project->cover_image = 'uploads/' . $faker->image('storage/app/public/uploads/', fullPath: false, category: 'Projects', format: 'jpg', word: $Project->title, gray: true);
            $Project->save();
        }
    }
}