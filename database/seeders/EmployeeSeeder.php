<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(base_path("database/datasets/hgcdEmp.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                try {
                    DB::beginTransaction();
                    Employee::create([
                        'emp_code' => $data[1],
                        'full_name' => $data[2],
                        'dob' => $data[3],
                        'fathers_name' => $data[4],
                        'gender' => $data[5],
                        'office_name' => $data[6],
                        'district' => $data[7],
                        'designation' => $data[8],
                        'tribe_name' => $data[9],
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
