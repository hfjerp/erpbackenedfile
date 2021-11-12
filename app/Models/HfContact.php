<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HfContact extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function familyMemberContact()
    {
        return $this->belongsTo(HfFamilyMemberContact::class);
    }

    public function familyContact()
    {
        return $this->belongsTo(HfFamilyContact::class);
    }
}
