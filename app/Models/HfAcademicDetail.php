<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HfAcademicDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function familyMemberAcademy()
    {
        return $this->belongsTo(HfFamilyMemberAcademy::class);
    }
}
