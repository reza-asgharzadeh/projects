<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'expiry_date',
        'is_approved'
    ];

    public function courses(){
        return $this->hasMany(Course::class);
    }

    public function is_approved(){
        return $this->is_approved ? 'فعال' : 'غیرفعال';
    }
}
