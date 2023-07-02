<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{


    protected $fillable = ['name', 
    'address1', 'address2',
     'truck_id', 
     'week4','week4Value','week4Amnt',
      'week3', 'week3Value', 'week3Amnt' , 
      'week2', 'week2Value','week2Amnt',
       'week1','week1Value','week1Amnt', 
       'weekcr', 'weekcrValue','weekcrAmnt'];
}
