<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    use HasFactory;
    protected $fillable = [
        'bank_id',
        'product_id',
        'product_name',
        'logo',
        'link',
        'fees',
        'tae',
        'annual_fee_first_year'
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'card_features')->withPivot('extra_info');
    }

    public function manualEdits()
    {
        return $this->hasMany(ManualEdit::class);
    }
}
