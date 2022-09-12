<?php

namespace App\Models\backend\home;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gallery extends Model
{
    use HasFactory;
    protected $table = "galleries";
    protected $guarded = [];
}
