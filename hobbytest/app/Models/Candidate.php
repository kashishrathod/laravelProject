<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'hobby_id', 
        'name',
        'surname',
        'description',
        'hobby_name',
        'language', 
    ];
}
