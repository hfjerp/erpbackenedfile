<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HfFamilyAddress extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function family()
    {
        return $this->belongsTo(HfFamily::class);
    }

    public function address()
    {
        return $this->hasOne(HfAddress::class,'id', 'address_id');
    }
}
