<?php

namespace App\Models\backend\home;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class page extends Model
{
    use HasFactory;
    protected $table = "pages";
    protected $guarded = [];
}
