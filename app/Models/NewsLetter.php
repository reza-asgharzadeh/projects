<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsLetter extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'status'
    ];

    public function status(){
        return $this->status ? 'فعال' : 'غیرفعال';
    }

    public function getCreatedAtInJalali()
    {
        return verta($this->created_at)->format('Y/m/d');
    }

    public function getUpdatedAtInJalali()
    {
        return verta($this->updated_at)->format('Y/m/d');
    }
}
