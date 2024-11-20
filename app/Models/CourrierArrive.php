<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourrierArrive extends Model
{
    use HasFactory;

    protected $fillable = [
        "numPrimaire",
        "reference",
        "numEnregistrement",
        "objet",
        "structure",
        "referencePJ",
        "priorite",
        "nomExpediteur",
        "dateArrive",
        "numReponse",
        "dateReponse",
        "dateSaisi",
        "email",
        "nombrePiece",
        "estEnvoyer",
        "courrierNumerise",
        "chrono_id",
        "nature_courrier_arrive_id",
        "categorie"
        
    ];

    public function chrono(){
       return $this->belongsTo(Chrono::class, "chrono_id", "id");
    }

    public function nature(){
       return $this->belongsTo(NatureCourrierArrive::class, "nature_courrier_arrive_id", "id");
    }

    public function file(){
        return $this->belongsTo(FileCourrierArrive::class, "file_courrier_arrive_id", "id");
    }

    public function piecejointeCA(){
        return $this->hasMany(PieceJointeCourrierArrivee::class);
    }

    public function annotation(){
        return $this->hasMany(AnnotationArrivee::class);
    }

    public function fonctions(){
        return $this->belongsToMany(Fonction::class, "courrier_arrive_fonction", "courrier_arrive_id", "fonction_id");
    }

    //fonction permettant de savoir si le courrier est envoyé à un agent
    public function hasFonction($fonction){
        return $this->fonctions()->where("code_fonction", $fonction)->first() !== null;
    }

    //fonction permettant de savoir si le courrier est envoyé à plusieurs agent
    public function hasAnyFonction($fonctions){
        return $this->fonctions()->whereIn("code_fonction", $fonctions)->first() !== null;
    }


}















