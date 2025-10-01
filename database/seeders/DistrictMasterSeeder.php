<?php

namespace Database\Seeders;

use App\Models\DistrictMaster;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DistrictMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DistrictMaster::truncate();
        $csvFile = fopen(base_path("database/datasets/districtMaster.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                try {
                    DB::beginTransaction();
                    DistrictMaster::create([
                        'name' => $data[1],
                    ]);

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();

                    Log::info($e->getMessage());
                    continue;
                }
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
