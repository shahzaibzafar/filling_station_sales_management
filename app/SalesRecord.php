<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesRecord extends Model
{
   protected $fillable = [
        'salesid', 'proid', 'buyprice', 'sellprice', 'qty', 'revenue', 'subtotal', 'type',
    ];

}
