<?php

namespace Database\Seeders;

use Illuminate\Support\Str; // 👈  Importami
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

        public function run()
        {
    
            $types = ['Frontend', 'Backend', 'Full Stack', 'Programming', 'DevOps'];
    
            foreach ($types as $type) {
                $newType = new Type();
                $newType->name = $type;
                $newType->slug = Str::slug($newType->name);
                $newType->save();
            }
        }
    }

