<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fonction extends Model
{
    use HasFactory;

    public function direction(){
        return $this->belongsTo(Direction::class, "direction_id", "id");
    }

    public function user(){
        return $this->hasMany(User::class);
    }

    public function courrier(){
        return $this->belongsToMany(CourrierArrive::class, "courrier_arrive_fonction", "fonction_id", "courrier_arrive_id");
    }


    public function users(){
        return $this->belongsToMany(User::class, "user_fonction_courrier", "fonction_id", "user_id");
    }
}
