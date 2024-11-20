<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typeAnnotation extends Model
{
    use HasFactory;

    protected $table = "type_annotations";

    protected $fillable = ["libAnnotation"];

    public function annotations(){
        return $this->belongsToMany(AnnotationArrivee::class, "arrive_type", "type_annotation_id", "annotation_arrivee_id");
    }
}
