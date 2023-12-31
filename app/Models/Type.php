<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Manufacturer;

class Type extends Model
{

    use HasFactory;

    public function maufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }
}
