<?php

namespace Database\Seeders;

use App\Models\Route;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Route::truncate();
        $csvFile = fopen(base_path("database/data/routes.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, separator: ",")) !== FALSE) {
            if (!$firstline) {
                Route::create([
                    "start_place" => $data['0'],
                    "end_place" => $data['1'],
                    "truck_id" => $data['2'],
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
