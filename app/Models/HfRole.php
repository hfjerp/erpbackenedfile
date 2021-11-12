<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HfRole extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(HfUser::class);
    }
    
    public function getRoleDetail(HfRole $HfRole)
    {
        return [
            'fetch aagtha illa',
        ];
    }
}
