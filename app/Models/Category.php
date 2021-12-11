<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category_id'
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function Children()
    {
        return $this->hasMany(Category::class);
    }

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'categorizable');
    }

    public function courses()
    {
        return $this->morphedByMany(Course::class, 'categorizable');
    }
}
