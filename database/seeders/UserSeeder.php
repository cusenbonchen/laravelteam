<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create(); 
        \DB::table('users')->insert([
            'username' => 'admin', 
            'password' => Hash::make('admin'), 
            'first_name' => 'Đạt Văn',
            'last_name' => 'Tây',
            'status'=> 1, 
            'projects' => json_encode($faker->unique()->randomElements(range(1, 20), 10)),
            'email'=> 'htmlcoder93@gmail.com', 
        ]);  
        for ($i=1; $i <= 5; $i++) { 
            \DB::table('users')->insert([
                'username' => 'member0'.$i, 
                'password' => Hash::make('123'), 
                'first_name' => 'Bé',
                'last_name' => 'Đạt'.$i,
                'status'=> 1, 
                'projects' => json_encode($faker->unique()->randomElements(range(1, 20), 10)),
                'email'=> 'htmlcoder'.$i.'@gmail.com', 
            ]);  
        }
    }
}
