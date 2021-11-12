<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HfFamilyMemberAcademy extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function familyMember()
    {
        return $this->belongsTo(HfFamilyMember::class);
    }

    public function academicDetail()
    {
        return $this->hasOne(HfAcademicDetail::class, 'id', 'academy_detail_id');
    }
}
