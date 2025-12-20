<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonalInfoSeeder extends Seeder
{
    public function run()
    {
        DB::table('personal_infos')->insert([
            'user_id' => 1,
            'first_name' => 'ali',
            'last_name' => 'Amiri',
            'email' => 'anaamiri@gmail.com',
            'phone' => '+1 (555) 123-4567',
            'location' => 'Tehran',
            'marital_status' => 'Single',
            'gender' => 'Female',
            'birth_year' => '2005',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
