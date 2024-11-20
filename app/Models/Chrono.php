<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chrono extends Model
{
    use HasFactory;
    protected $fillable = ["lib_chrono"];

    public function courrier_arrive(){
       return $this->hasMany(CourrierArrive::class);
    }
}
