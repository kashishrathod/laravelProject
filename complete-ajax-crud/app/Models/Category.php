<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


class category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_name',
       
    ];
    public function Username(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
