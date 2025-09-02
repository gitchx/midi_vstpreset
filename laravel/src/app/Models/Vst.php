<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vst extends Model
{
    protected $fillable = [
        'name',
        'vendor',
        'version',
        'description',
    ];
}
