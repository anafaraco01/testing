<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{



    protected $fillable = ['invoice_id', 'debtor_code', 'truck_id', 'week', 'date', 'profit_margin', 'value', 'amount_to_pay',   'payment_method', 'paid', 'refunded'];
}
