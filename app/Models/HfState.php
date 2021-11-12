<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HfState extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function district()
    {
        return $this->hasMany(HfState::class, 'state_id','id');
    }
}
