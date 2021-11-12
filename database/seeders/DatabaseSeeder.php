<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\HfUser::factory()->create([
            'name' => 'superadmin',
            'email' => 'superadmin@email.com',
            'password' => bcrypt("superadmin@123"),
            'role_id' => 1,
            'jamath_id' => 2,
            'parent_id' => 0,
            ]);
        \App\Models\HfUser::factory()->create([
            'name' => 'admin',
            'email' => 'admin@email.com',
            'password' => bcrypt("admin@123"),
            'role_id' => 2,
            'jamath_id' => 2,
            'parent_id' => 1,
        ]);
        \App\Models\HfUser::factory()->create([
            'name' => 'editor',
            'email' => 'editor@email.com',
            'password' => bcrypt("editor@123"),
            'role_id' => 3,
            'jamath_id' => 1,
            'parent_id' => 1,
        ]);
        \App\Models\HfUser::factory()->create([
            'name' => 'guest',
            'email' => 'guest@email.com',
            'password' => bcrypt("guest@123"),
            'role_id' => 4,
            'jamath_id' => 1,
            'parent_id' => 1,
        ]);
        \App\Models\HfRole::create([
            'name' => 'SA',
        ]);
        \App\Models\HfRole::create([
            'name' => 'ADMIN',
            'parent_id' => 1,
        ]);
        \App\Models\HfRole::create([
            'name' => 'EDITOR',
            'parent_id' => 1,

        ]);
        \App\Models\HfRole::create([
            'name' => 'GUEST',
            'parent_id' => 1,
        ]);

        \App\Models\HfJamath::create([
            'name' => 'jamath1',
            'address_id' => 1
        ]);

        \App\Models\HfJamath::create([
            'name' => 'jamath2',
            'address_id' => 2
        ]);
        \App\Models\HfAddress::create([
            'street' => 'street1'
        ]);
        \App\Models\HfAddress::create([
            'street' => 'street2'
        ]);

        // Contact types
        \App\Models\HfContactType::create([
            'name'=>'Contact No.'
        ]);
        \App\Models\HfContactType::create([
            'name'=>'Email'
        ]);


        //  Shelter Types
        \App\Models\HfShelterType::create([
            'name' => 'Kaccha House'
        ]);
        \App\Models\HfShelterType::create([
            'name' => 'Pucca House'
        ]);
        \App\Models\HfShelterType::create([
            'name' => 'RCC'
        ]);
        \App\Models\HfShelterType::create([
            'name' => 'Apartment'
        ]);
        \App\Models\HfShelterType::create([
            'name' => 'Villa'
        ]);
        \App\Models\HfShelterType::create([
            'name' => 'Other'
        ]);

        // Shelter Ownership
        \App\Models\HfShelterOwnership::create([
            'name' => 'Ownership'
        ]);
        \App\Models\HfShelterOwnership::create([
            'name' => 'Rented'
        ]);
        \App\Models\HfShelterOwnership::create([
            'name' => 'Lease'
        ]);
        \App\Models\HfShelterOwnership::create([
            'name' => 'Free'
        ]);
        \App\Models\HfShelterOwnership::create([
            'name' => 'Other'
        ]);

        // Languages
        \App\Models\HfLanguage::create([
            'name' => 'English'
        ]);
        \App\Models\HfLanguage::create([
            'name' => 'Hindi'
        ]);
        \App\Models\HfLanguage::create([
            'name' => 'Urdu'
        ]);
        \App\Models\HfLanguage::create([
            'name' => 'Kannada'
        ]);
        \App\Models\HfLanguage::create([
            'name' => 'Tulu'
        ]);

        // Religions
        \App\Models\HfReligion::create([
            'name' => 'Islam'
        ]);
        \App\Models\HfReligion::create([
            'name' => 'Hinduism'
        ]);
        \App\Models\HfReligion::create([
            'name' => 'Christianity'
        ]);

        $majors = ['General','Science','Commerce','Arts','Music','Computer Science'];
        foreach($majors as $major){
            \App\Models\HfFamilyMemberAcademyMajor::create([
                'name' => $major
            ]);
        }
    }
}
