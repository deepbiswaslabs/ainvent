<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerPayment extends Model
{
    protected $fillable = ['customer_id','total_due','invoice_total','invoice_id'];

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function invoice(){
        return $this->belongsTo(Invoice::class,'invoice_id');
    }
}