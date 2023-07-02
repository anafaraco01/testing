<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {


    // protected $fillable = [
    //     'name',
    //     'address1', 'address2',
    //     'truck_id',
    //     'week4', 'week4Value', 'week4Amnt',
    //     'week3', 'week3Value', 'week3Amnt',
    //     'week2', 'week2Value', 'week2Amnt',
    //     'week1', 'week1Value', 'week1Amnt',
    //     'weekcr', 'weekcrValue', 'weekcrAmnt'
    // ];

        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address1');
            $table->string('address2');
            $table->foreignId('truck_id');
            // week4 stands for 4 weeks ago
            $table->string('week4');
            //create table entry with floating point number called week4Amnt
            $table->float('week4Value');
            $table->float('week4Amnt');
            $table->string('week3');
            $table->float('week3Value');
            $table->float('week3Amnt');
            $table->string('week2');
            $table->float('week2Value');
            $table->float('week2Amnt');
            $table->string('week1');
            $table->float('week1Value');
            $table->float('week1Amnt');
            // cr stands for current week
            $table->string('weekcr');
            $table->float('weekcrValue');
            $table->float('weekcrAmnt');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
