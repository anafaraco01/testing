<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::truncate();


        // $csvFile = fopen(base_path("database/data/customerlist.csv"), "r");
        // $firstline = true;
        // while (($data = fgetcsv($csvFile, 2000)) !== FALSE) {
        //     if (!$firstline) {
        //         Customer::create([
        //             "name" => $data['0'],
        //             "location" => $data['1'],
        //             "truck_id" => 1
        //         ]);
        //     }
        //     $firstline = false;
        // }
        // fclose($csvFile);
    }
}
