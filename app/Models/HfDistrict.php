<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HfDistrict extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function taluk()
    {
        return $this->hasMany(HfTaluk::class, 'district_id', 'id');
    }

    public function state()
    {
        return $this->belongsTo(HfState::class);
    }
}
