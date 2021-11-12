<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HfFamilyHead extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function family()
    {
        return $this->belongsTo(HfFamily::class);
    }

    public function familyMember()
    {
        return $this->belongsTo(HfFamilyMember::class);
    }
}
