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
        //invoiceID debtorCode truckID week date amountToPay isPaid

        Schema::create('invoices', function (Blueprint $table) {
            $table->id('id');
            $table->string('invoice_id')->unique();
            $table->string('debtor_code');
            $table->integer('truck_id');
            $table->string('week');
            $table->string('date');
            $table->float('profit_margin');
            $table->float('value');
            $table->float('amount_to_pay'); 
            $table->string('payment_method');
            $table->boolean('paid');
            $table->boolean('refunded');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
