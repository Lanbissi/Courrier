<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NatureCourrierArrive extends Model
{
    use HasFactory;

    protected $fillable = ["nom"];

    protected $table = "nature_courrier_arrive";

    public function courrier_arrive(){
        return $this->hasMany(CourrierArrive::class);
    }
}
