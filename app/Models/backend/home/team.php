<?php

namespace App\Models\backend\home;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class team extends Model
{
    use HasFactory;
    protected $table = "teams";
    protected $guarded = [];
}
