<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HfFamilyFood extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function family()
    {
        return $this->belongsTo(HfFamily::class);
    }
}
