<?php

namespace Database\Seeders;

use App\Models\LocationMaster;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        LocationMaster::create([
            'name' => 'Billy Graham Rd Jn',
            'address' => 'BG Road, Civil Secretariat',
            'district_id' => '4',
        ]);

        LocationMaster::create([
            'name' => 'UBC Jn',
            'address' => 'Razhu Point, UBC',
            'district_id' => '4',
        ]);

        LocationMaster::create([
            'name' => 'TCP Gate',
            'address' => 'Phoolbari, Kohima',
            'district_id' => '4',
        ]);

        LocationMaster::create([
            'name' => 'PR HILL',
            'address' => 'PHQ Jn, Kohima',
            'district_id' => '4',
        ]);

        LocationMaster::create([
            'name' => 'Mission Compound',
            'address' => 'Mission Compound Jn, Kohima',
            'district_id' => '4',
        ]);
    }
}
