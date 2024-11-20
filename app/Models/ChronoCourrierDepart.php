<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChronoCourrierDepart extends Model
{
    use HasFactory;

    protected $fillable = ["nom"];

    public function courrierdepart(){
        return $this->hasMany(CourrierDepart::class);
    }
}
