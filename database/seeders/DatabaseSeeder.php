<?php

namespace Database\Seeders;

use App\Models\Patient;
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
        Patient::factory(10)->create();

        $this->call([
            DoctorSeeder::class,
            UserSeeder::class,
            RolesSeeder::class,
            UsersRolesSeeder::class,
            DrugSeeder::class,
        ]);
    }
}
