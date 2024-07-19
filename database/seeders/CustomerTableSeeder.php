<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use Faker\Factory as faker;
class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker= Faker::create();
        for($i=0;$i<100;$i++){
            Customer::create([
                'name'=>$faker->name,
                'email'=>$faker->email,
                'phone'=>$faker->phoneNumber,
                'password'=>$faker->password,
                'address'=>$faker->address,
                'dob'=>$faker->date,
                'gender'=>$faker->randomElement(['m','f']),
                // 'status'=>$faker->randomElement(['active','inactive']),
                
            ]);
        }
    }
}
