<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HfFamily extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function currentFamilyAddress()
    {
        return $this->hasOne(HfFamilyAddress::class,'id', 'family_address_id');
    }
    public function hfreligion()
    {
        return $this->hasOne(HfReligion::class,'id', 'religion');
    }
    public function hfmaritial()
    {
        return $this->hasOne(HfFamilyMember::class,'id', 'family_id');
    }

    public function familyAddress()
    {
        return $this->hasMany(HfFamilyAddress::class, 'family_id', 'id');
    }
    public function familyContact()
    {
        return $this->hasMany(HfFamilyContact::class, 'family_id', 'id');
    }

    public function familyMember()
    {
        return $this->hasMany(HfFamilyMember::class, 'family_id', 'id');
    }

    public function familyHead()
    {
        return $this->hasOne(HfFamilyHead::class,'family_id','id');
    }

    public function shelter()
    {
        return $this->hasOne(HfShelter::class,'family_id','id');
    }
    public function bank()
    {
        return $this->hasOne(HfFamilyBank::class,'family_id','id');
    }
    public function banker()
    {
        return $this->hasOne(HfFamilyMemberBank::class,'family_member_id','id');
    }
    public function food()
    {
        return $this->hasOne(HfFamilyFood::class,'family_id','id');
    }
    public function getfamilyDetail(HfFamily $hfFamily)
    {
        return [
            $hfFamily,
        ];
    }
}
