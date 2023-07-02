<?php

namespace Database\Seeders;

use App\Models\Stop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stop::truncate();
        $csvFile = fopen(base_path("database/data/stops.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, separator: ";")) !== FALSE) {
            if (!$firstline) {
                if ($data['4'] == '') {
                    $data['4'] = 0;
                }
                Stop::create([
                    "day" => $data['0'],
                    "location" => $data['1'],
                    "time" => $data['2'],
                    "occasion" => $data['3'],
                    "length" => $data['4']
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
