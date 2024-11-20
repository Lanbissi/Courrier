<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PieceJointeAnnotation extends Model
{
    use HasFactory;

    public function annotationarrivee(){
        return $this->belongsTo(AnnotationArrivee::class, "annotation_arrivee_id", "id");
    }
}
