<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();  
        for ($i=1; $i <= 20; $i++) { 
            \DB::table('projects')->insert([ 
                'code' => 'VMN-COD-0093'.$i,
                'project_name' => $faker->title,
                'client' => 'Client'.$i,
                'level' => $faker->numberBetween(2, 6),
                'type' => $faker->numberBetween(1, 3),
                'process' => $faker->numberBetween(1, 5),
                'content'=> 'Updating', 
                'assign' => json_encode($faker->unique()->randomElements(range(1, 5), $faker->numberBetween(2, 5))), 
            ]);  
            
        }
    }
}
