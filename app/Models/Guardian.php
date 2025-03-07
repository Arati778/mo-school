<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;
    protected $fillable = [
        "first_name",
        'last_name',
        'phone',
    ];

    public function student()
    {
        return $this->hasMany(Student::class);
    }
}
