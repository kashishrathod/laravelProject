<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'hobby',
        'address',
        'profile_pic',
        'education',
    ];
    public function UserData(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}