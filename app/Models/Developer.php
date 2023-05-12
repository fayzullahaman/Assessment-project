<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;
    protected $table = 'developers';
    protected $fillable = [
        'name',
        'email',
        'image',
        'gender',
        'skills',
    ];
    public function setSkillsAttribute($value)
    {
        $this->attributes['skills'] = json_encode($value);
    }

    public function getSkillsAttribute($value)
    {
        return $this->attributes['skills'] = json_decode($value);
    }
}
