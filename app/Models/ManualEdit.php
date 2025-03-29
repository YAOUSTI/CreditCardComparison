<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManualEdit extends Model
{
    protected $fillable = ['credit_card_id', 'field_name', 'manual_value'];

    public function creditCard()
    {
        return $this->belongsTo(CreditCard::class);
    }
}
