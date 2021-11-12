<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HfFamilyContact extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function contact()
    {
        return $this->hasOne(HfContact::class, 'id', 'contact_id');
    }
}
