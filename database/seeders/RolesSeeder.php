<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Jonas Balciunas']);
        Role::create(['name' => 'Andrius Lubauskas']);
        Role::create(['name' => 'Receptionist']);
    }
}
