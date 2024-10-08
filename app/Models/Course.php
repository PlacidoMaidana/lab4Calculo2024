<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

// Un curso tiene muchos estudiantes
 public function students()
 {
   return $this->hasMany(Student::class);
 }


}
