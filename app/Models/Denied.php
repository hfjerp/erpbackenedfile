<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denied extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function jamathAccess()
    {
        return $this->belongsTo(HfJamath::class);
    }
}
