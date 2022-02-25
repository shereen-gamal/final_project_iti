<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // by default we have one super admin and two admins in our system
        //create one super admin for this system 
        User::create([
             'email' => 'superadmin@mail.com',
             'password' =>Hash::make('Super_admin@app0'),
             'firstname' => 'Ahmed',
             'lasttname' => 'Helmy',
             'date_of_birth' =>'1990-01-01',
             'gender' => 'male',
             'location' => 'Egypt, Cairo',
             'userid' => uniqid(),
             'name' => 'Ahmed Helmy',
             'isAdmin' => true,
             'school' => 'Shoubra faculty of arts',
             'address' => '3 st cairo, cairo',
             'profilePic' => 'default.jpg',
             'mobile' => '01234567891',
             'hasCover' => false,
             'intro' => 'Super Admin Account',
             'permission'=> 1,
        ]);

        //create two admin for this system 
        User::create([
            'email' => 'admin1@mail.com',
            'password' =>Hash::make('Admin_1@app'),
            'firstname' => 'Shereen',
            'lasttname' => 'Gamal',
            'date_of_birth' =>'1998-05-05',
            'gender' => 'female',
            'location' => 'Egypt, Giza',
            'userid' => uniqid(),
            'name' => 'Shereen Gamal',
            'isAdmin' => true,
            'school' => 'Shoubra faculty of engineering',
             'address' => '3 st gamal abdelnasser, shoubra',
            'profilePic' => 'default.jpg',
            'mobile' => '01112131415',
            'hasCover' => false,
            'intro' => 'Admin Account',
            'permission'=> 2,
       ]);

       User::create([
        'email' => 'admin2@mail.com',
        'password' =>Hash::make('Admin_2@app'),
        'firstname' => 'Sameh',
        'lasttname' => 'Hussien',
        'date_of_birth' =>'1970-03-03',
        'gender' => 'male',
        'location' => 'Egypt, Alexandiria',
        'userid' => uniqid(),
        'name' => 'Sameh Hussien',
        'isAdmin' => true,
        'school' => 'faculty of arts',
        'address' => '7 st Alexandiria , Alexandiria',
        'profilePic' => 'default.jpg',
        'mobile' => '01011021034',
        'hasCover' => false,
        'intro' => 'Admin Account',
        'permission'=> 2,
   ]);

     

    }
}
