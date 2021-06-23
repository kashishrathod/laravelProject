<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'tag_id', 
        'title',
        'description',
        'blog_img', 
    ];
    public function blog() {
        return $this->hasMany(Tag::class);
    }
}
