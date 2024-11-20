<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnotationArrivee extends Model
{
    use HasFactory;

    protected $fillable = [
         'dateAnnotation',
         'dateSuivi',
         'numero',
         'objet',
         'dateFinTraitementTheorique',
         'dateFinTraitementReel',
         'delaiTheorique',
         'delaiReel',
         'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function piecejointeannotation(){
        return $this->hasMany(PieceJointeAnnotation::class);
    }

    public function courrier(){
        return $this->belongsTo(CourrierArrive::class, "courrier_arrive_id", "id");
    }


    public function types(){
        return $this->belongsToMany(typeAnnotation::class, "arrive_type", "annotation_arrivee_id", "type_annotation_id");
    }

    //fonction permettant de savoir si l'annotation à un type
    public function hasType($type){
        return $this->types()->where("libAnnotation", $type)->first() !== null;
    }

    //fonction permettant de savoir si l'annotation à plusieurs types
    public function hasAnyType($types){
        return $this->types()->whereIn("libAnnotation", $types)->first() !== null;
    }
}














