<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HfJamath extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->hasMany(HfUser::class, 'jamath_id', 'id');
    }

    public function address()
    {
        return $this->hasOne(HfAddress::class, 'id', 'address_id');
    }

    // accessors

    public function getJamathDetail(HfJamath $hfJamath)
    {
        return [
            $hfJamath,
        ];
    }

    public function accessDenied()
    {
        return $this->hasMany(Denied::class,'jamath_id', 'id');
    }

}
