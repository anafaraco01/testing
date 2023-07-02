<?php

namespace Database\Seeders;

use App\Models\Truck;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TruckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Truck::truncate();

        $csvFile = fopen(base_path("database/data/trucks.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile,  separator: ",")) !== FALSE) {
            if (!$firstline) {
                if ($data['3'] == '') {
                    $data['3'] = null;
                } if ($data['4'] == '') {
                    $data['4'] = null;
                }
                Truck::create([
                    "licence" => $data['0'],
                    "location" => $data['1'],
                    "status" => $data['2'],
                    "posX" => $data['3'],
                    "posY" => $data['4']
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
