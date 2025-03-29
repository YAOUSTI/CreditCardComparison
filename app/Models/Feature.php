<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = ['name', 'type'];

    public function creditCards()
    {
        return $this->belongsToMany(CreditCard::class, 'card_features');
    }
}
