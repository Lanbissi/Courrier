<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PieceJointeCourrierArrivee extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'pjNumerise',
        'courrier_arrive_id'
    ];

    public function courrier_arrive(){
        return $this->belongsTo(CourrierArrive::class, "courrier_arrive_id", "id");
    }
}
