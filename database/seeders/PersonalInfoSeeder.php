<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonalInfoSeeder extends Seeder
{
    public function run()
    {
        DB::table('personal_infos')->insert([
            'first_name' => 'Ana',
            'last_name' => 'Amiri',
//            'job_title' => 'Product Designer',
            'email' => 'anaamiri@gmail.com',
            'phone' => '+1 (555) 123-4567',
            'location' => 'Tehran',
//            'linkedin' => 'https://linkedin.com/in/anaamiri',
//            'portfolio' => 'https://portfolio.example.com',
            'marital_status' => 'Single',
            'gender' => 'Female',
            'birth_year' => '2005',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
