<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HfFamilyMember extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function family()
    {
        return $this->belongsTo(HfFamily::class);
    }

    public function family2()
    {
        return $this->belongsTo(HfFamily::class);
    }

    public function familyMemberContact()
    {
        return $this->hasMany(HfFamilyMemberContact::class, 'family_member_id','id');
    }

    public function aadhar()
    {
        return $this->hasOne(HfFamilyMemberAadhar::class, 'family_member_id', 'id');
    }

    public function voterId()
    {
        return $this->hasOne(HfFamilyMemberVoterId::class, 'family_member_id','id');
    }
    public function banki()
    {
        return $this->hasOne(HfFamilyMemberBank::class, 'family_member_id', 'id');
    }

    public function occupationDetail()
    {
        return $this->hasOne(HfOccupationDetail::class, 'family_member_id', 'id');
    }

    public function familyMemberAcademy()
    {
        return $this->hasMany(HfFamilyMemberAcademy::class, 'family_member_id', 'id');
    }

    public function familyHead()
    {
        return $this->hasOne(HfFamilyHead::class, 'family_member_id', 'id');
    }

    public function healthy()
    {
        return $this->hasOne(HfFamilyMemberHealth::class,'family_member_id', 'id');
    }

    public function labour()
    {
        return $this->hasOne(HfFamilyMemberLabour::class,'family_member_id', 'id');
    }

    public function seniorCitizen()
    {
        return $this->hasOne(HfFamilyMemberSeniorCitizen::class,'family_member_id', 'id');
    }

    public function familyMemberHealtDetail()
    {
        return $this->hasOne(HfFamilyMemberHealthDetail::class, 'family_member_id', 'id');
    }

    public function familyMemberHealtSupport()
    {
        return $this->hasOne(HfFamilyMemberHealthSupport::class, 'family_member_id', 'id');
    }

    public function familyMemberOccupationSupport()
    {
        return $this->hasOne(HfFamilyMemberOccupationSupport::class, 'family_member_id', 'id');
    }

    public function familyMemberAcademySupport()
    {
        return $this->hasOne(HfFamilyMemberAcademySupport::class, 'family_member_id', 'id');
    }

    public function familyMemberPrioritySupport()
    {
        return $this->hasOne(HfFamilyMemberPrioritySupport::class, 'family_member_id', 'id');
    }

    public function familyMemberGoal()
    {
        return $this->hasOne(HfFamilyMemberGoal::class, 'family_member_id', 'id');
    }

    public function familyMemberSkill()
    {
        return $this->hasOne(HfFamilyMemberSkill::class, 'family_member_id', 'id');
    }

    public function familyMemberHobby()
    {
        return $this->hasOne(HfFamilyMemberHobby::class, 'family_member_id', 'id');
    }

    public function familyMemberCourse()
    {
        return $this->hasOne(HfFamilyMemberOtherCourse::class, 'family_member_id', 'id');
    }

}
