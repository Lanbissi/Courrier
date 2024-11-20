<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourrierDepart extends Model
{
    use HasFactory;

    protected $fillable = [
        'numOrdre',
        'nombrePiece',
        'dateDepart',
        'destinataire',
        'objet',
        'observation',
        'chrono_id'
    ];

    public function chrono(){
        return $this->belongsTo(ChronoCourrierDepart::class, "chrono_id", "id");
    }
}
