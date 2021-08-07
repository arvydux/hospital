<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Doctor::create([
            'name' => 'Jonas Balciunas',
            'expertise' => 'Cardiologist',
            'duration' => '10',
        ]);

        Doctor::create([
            'name' => 'Andrius Lubauskas',
            'expertise' => 'Nephrologist',
            'duration' => '25',
        ]);

        Doctor::create([
            'name' => 'Vaidotas Silickas',
            'expertise' => 'Rheumatologist',
            'duration' => '20',
        ]);

        Doctor::create([
            'name' => 'Juozas Stanaitis',
            'expertise' => 'Oncologist',
            'duration' => '15',
        ]);

        Doctor::create([
            'name' => 'Tomas Budrius',
            'expertise' => 'Radiologist',
            'duration' => '30',
        ]);
    }
}
