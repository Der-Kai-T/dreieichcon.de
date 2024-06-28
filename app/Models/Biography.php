<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Biography extends Model
{
    use Uuids;
    protected $fillable = [
        'name',
        'short',
        'long',
    ];
}