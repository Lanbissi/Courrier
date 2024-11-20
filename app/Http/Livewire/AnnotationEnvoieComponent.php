<?php

namespace App\Http\Livewire;

use App\Models\AnnotationArrivee;
use App\Models\CourrierArrive;
use App\Models\Fonction;
use App\Models\PieceJointeAnnotation;
use App\Models\typeAnnotation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AnnotationEnvoieComponent extends Component
{
    use WithPagination, WithFileUploads;
    public $dateAnnotationAperçu;
    public $dateSuiviAperçu;
    public $numeroAperçu;
    public $objetAnnotationAperçu;
    public $dateTheoriqueAperçu;
    public $dateReelAperçu;
    public $delaiTheoriqueAperçu;
    public $delaiReelAperçu;

    public $selectedTypeCourrier;
    public $fichier;

    public $numeroApercu;
    public $referenceApercu;
    public $numEnregistrementAperçu;
    public $objetAperçu;
    public $structureAperçu;
    public $refpjAperçu;
    public $prioriteAperçu;
    public $consigneCourrier;

    public $AnnotationPjId;
    public $listPjAnnotation;

    public $AnnotationEditId;
    public $userEditId;
    public $CourrierEditId;
    public $dateAnnotationEdit;
    public $dateSuivieEdit;
    public $numeroEdit;
    public $objetEdit;
    public $dateTheoriqueEdit;
    public $dateReelEdit;
    public $delaiTheoriqueEdit;
    public $delaiReelEdit;
    public $courrierStat;

    public $annotationEnvoyerId;
    public $delai;

    public $seepjApercuId;
    public $courrierIdSuivi;

    public $courrierIdFin;
    public $user_idFin;
    public $annot_idFin;
    public $dateFin;
    public $dateannotFin;

    public $annotationEnvoyerIdEdit;
    public $annotationuserEdit;
    public $annotationcreateEdit;

    public $typefonctionEdit = [];
    public $dateReel;

    public $dateA;

    public $currentPage = PAGELIST;
    protected $paginationTheme = "bootstrap";
    use WithPagination;
    public function render()
    {
        Carbon::setLocale("fr");
        //dump(Auth::user()->service->id);
        $Annotations = [
            "courriers" => DB::table('user_fonction_courrier')->distinct()
             ->join('fonctions', 'user_fonction_courrier.fonction_id', '=', 'fonctions.id')
             ->join('users', 'user_fonction_courrier.user_id', '=', 'users.id')
             ->join('annotation_arrivees', 'users.id', '=', 'annotation_arrivees.user_id')
             ->join('courrier_arrives', 'annotation_arrivees.courrier_arrive_id', '=', 'courrier_arrives.id')
             ->select('courrier_arrives.id', 'courrier_arrives.numPrimaire', 'courrier_arrives.categorie', 'annotation_arrivees.dateFinTraitementTheorique', 'annotation_arrivees.delaiTheorique', 'nom')
             ->where('user_fonction_courrier.user_id', Auth::user()->service->id)
             //->where('user_fonction_courrier.statutenvoie', '=',1)
             //->where('user_fonction_courrier.envoyerautreagent','=', 0)
             //->where('statut', '=', 2)
             ->get()
          ] ;
        //$Annotations = AnnotationArrivee::where('user_id', Auth::user()->id)->latest()->paginate(5);
        $pj = PieceJointeAnnotation::where('annotation_arrivee_id', $this->AnnotationPjId)->paginate(5);
        $apercudelaPJ = PieceJointeAnnotation::where('id', $this->seepjApercuId)->get();
        return view('livewire.annotationenvoie.index', $Annotations, ["pj" => $pj, "apercudelaPJ" => $apercudelaPJ ])->extends("layouts.base")->section("contenu");
    }

    public function goToListCourrier(){
        $this->currentPage = PAGELIST;
    }

    public function aperçuAnnotation($id){
        $annotation = AnnotationArrivee::find($id);
    $this->selectedTypeCourrier = $annotation->courrier->numPrimaire;
    $this->dateAnnotationAperçu =  date('d-m-Y', strtotime($annotation->dateAnnotation));
    $this->dateSuiviAperçu =  date('d-m-Y', strtotime($annotation->dateSuivi));
    $this->numeroAperçu = $annotation->numero;
    $this->objetAperçu = $annotation->objet;
    $this->dateTheoriqueAperçu =  date('d-m-Y', strtotime($annotation->dateFinTraitementTheorique));
    $this->dateReelAperçu =  date('d-m-Y', strtotime($annotation->dateFinTraitementReel));
    $this->delaiTheoriqueAperçu = $annotation->delaiTheorique;
    $this->delaiReelAperçu = $annotation->delaiReel;


        $this->currentPage = PAGEAPERCUANNOTATION;
    }

    public function goToEditAnnote($id){
        $Annotation = AnnotationArrivee::find($id);
        $this->AnnotationEditId = $Annotation->id;
        $this->userEditId = $Annotation->user_id;
        $this->CourrierEditId = $Annotation->courrier_arrive_id;
        $this->dateA = $Annotation->created_at;
        
        $this->dateAnnotationEdit = date('Y-m-d', strtotime($Annotation->dateAnnotation));
        $this->dateSuivieEdit = date('Y-m-d', strtotime($Annotation->dateSuivi));
        $this->numeroEdit = $Annotation->numero;
        $this->objetEdit = $Annotation->objet;
        $this->dateTheoriqueEdit = date('Y-m-d', strtotime($Annotation->dateFinTraitementTheorique));
        $this->dateReelEdit = date('Y-m-d', strtotime($Annotation->dateFinTraitementReel));
        $this->delaiTheoriqueEdit = $Annotation->delaiTheorique;
        $this->delaiReelEdit = $Annotation->delaiReel;

        $this->currentPage = PAGEEDITFORM;

      $this->typeFonctionEdit();
    }

    public function typeFonctionEdit(){
        $this->typefonctionEdit["types"] = [];
        $this->typefonctionEdit["fonctions"] = [];

        $mapForCB = function($value){
            return $value["id"];
        };

        $typeIds = array_map($mapForCB, AnnotationArrivee::find($this->AnnotationEditId)->types->toArray());
        $fonctionIds = array_map($mapForCB, User::find($this->userEditId)->fonctions()
        ->where('user_fonction_courrier.created_at', $this->dateA)
        ->where('user_fonction_courrier.user_id', $this->userEditId)
        ->get()->toArray()
       );

        foreach(typeAnnotation::all() as $type){
            if(in_array($type->id, $typeIds)){
                 array_push($this->typefonctionEdit["types"], ["type_id"=>$type->id, "type_nom"=>$type->libAnnotation, "active"=>true]);
            }else{
                array_push($this->typefonctionEdit["types"], ["type_id"=>$type->id, "type_nom"=>$type->libAnnotation, "active"=>false]);
            }
        }

        foreach(Fonction::all() as $fonction){
            if(in_array($fonction->id, $fonctionIds)){
                 array_push($this->typefonctionEdit["fonctions"], ["fonction_id"=>$fonction->id, "fonction_nom"=>$fonction->code_fonction, "active"=>true]);
            }else{
                array_push($this->typefonctionEdit["fonctions"], ["fonction_id"=>$fonction->id, "fonction_nom"=>$fonction->code_fonction, "active"=>false]);
            }
        }
    }

    public function annotationEdit(){
        $this->validate([
         // 'dateAnnotationEdit' => 'required',
         // 'dateSuivieEdit' => 'required',
          'numeroEdit' => 'required|numeric',
          'objetEdit' => 'required',
          'dateTheoriqueEdit' => 'required',
          //'dateReelEdit' => 'required',
          //'delaiTheoriqueEdit' => 'required',
          //'delaiReelEdit' => 'required'
        ]);

        $annotation = AnnotationArrivee::find($this->AnnotationEditId);
        
        $annotation->dateAnnotation = Carbon::now()->toDateTimeString();
        $annotation->dateSuivi = Carbon::now()->toDateTimeString();
        $annotation->numero = $this->numeroEdit;
        $annotation->objet = $this->objetEdit;
        $annotation->dateFinTraitementTheorique = $this->dateTheoriqueEdit;
        //$annotation->dateFinTraitementReel = $this->dateReelEdit;
        $annotation->delaiTheorique = $this->delaiTheoriqueEdit;
       // $annotation->delaiReel = $this->delaiReelEdit;
        $annotation->courrier_arrive_id = $this->CourrierEditId;
        //$annotation->user_id  = Auth::user()->service->id;
        $annotation->save();
        
        DB::table("arrive_type")->where("annotation_arrivee_id", $annotation->id)->delete();
         DB::table("user_fonction_courrier")->where("user_id", $annotation->user_id)->delete();

        foreach($this->typefonctionEdit["types"] as $type){
            if($type["active"]){
                AnnotationArrivee::find($this->AnnotationEditId)->types()->attach($type["type_id"]);
            }
        }

        foreach($this->typefonctionEdit["fonctions"] as $fonction){
            if($fonction["active"]){
                CourrierArrive::find($this->CourrierEditId)->fonctions()->attach($fonction["fonction_id"]);
                User::find($annotation->user_id)->fonctions()->attach($fonction["fonction_id"]);
            }
        }

        $this->annotationEnvoyerIdEdit = $annotation->id;
        $this->annotationuserEdit = $annotation->user_id;
        $this->annotationcreateEdit = $annotation->updated_at;

        DB::table('user_fonction_courrier')
        ->where('user_id', $this->annotationuserEdit)
        ->where('created_at', $this->annotationcreateEdit)
        ->update(['annotation_id' => $this->annotationEnvoyerIdEdit]);

       DB::table('user_fonction_courrier')
        ->where('user_id', $this->annotationuserEdit)
        ->where('created_at', $this->annotationcreateEdit)
        ->where('annotation_id', $this->annotationEnvoyerIdEdit)
        ->update(['statutenvoie' => 1]);

        //Actualiser date d'annotation théorique autre agent
        DB::table('annotation_arrivees')
           ->where('id', $annotation->id)
           ->where('user_id', Auth::user()->id)
           ->where('created_at', $annotation->updated_at)
           ->update(['delaiTheorique' => Carbon::parse($annotation->dateAnnotation)->diffInDays($annotation->dateFinTraitementTheorique)]);
          

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Annotation mis à jour avec succès!"]);
  }
  
  public function valider($id){
        $courrier = CourrierArrive::find($id);
        $this->courrierIdFin = $courrier->id;

        $users = AnnotationArrivee::where('courrier_arrive_id', $this->courrierIdFin)->first();
        
        $this->user_idFin = $users->user_id;
        $this->annot_idFin = $users->id;
        $this->dateFin = $users->created_at;
        $this->dateannotFin = $users->dateAnnotation;

        DB::table('user_fonction_courrier')
        ->where('annotation_id', $this->annot_idFin)
        ->where('created_at', $this->dateFin)
        ->where('user_id', $this->user_idFin)
        ->update(['dateFinReel' => Carbon::now()]);

        $donnee = DB::table('user_fonction_courrier')
        ->select('*')
        ->where('annotation_id', $this->annot_idFin)
        ->where('created_at', $this->dateFin)
        ->where('user_id', $this->user_idFin)
        ->first();

        DB::table('user_fonction_courrier')
        ->where('annotation_id', $this->annot_idFin)
        ->where('created_at', $this->dateFin)
        ->where('user_id', $this->user_idFin)
        ->update(['delaiReel' => Carbon::parse($this->dateannotFin)->diffInDays($donnee->dateFinReel)]);

        DB::table('user_fonction_courrier')
        ->where('annotation_id', $this->annot_idFin)
        ->where('created_at', $this->dateFin)
        //->where('user_id', $this->user_id)
        ->where('fonction_id', Auth::user()->service->id)
        ->update(['envoyerautreagent' => 1]);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Courrier traité avec succès!"]);

  }

   public function goToAddpj($id){
    $annotation = AnnotationArrivee::find($id); 
    $this->AnnotationPjId = $annotation->id;
    $this->listPjAnnotation = PieceJointeAnnotation::where('annotation_arrivee_id', $this->AnnotationPjId)->get();
    //dump($this->listPjAnnotation->annotationarrivee->pjNumerise);
    $this->currentPage = PAGEPJFORM;
   }

public function addPJ(){
    if (!empty($this->fichier)) {
        $this->validate([
            'fichier.*' => 'required',
        ]);
    }


    if (!empty($this->fichier)) {
        foreach ($this->fichier as $fichier) {
            $fichier->store('fichier');

            $pjFile = new PieceJointeAnnotation();
            $pjFile->pjNumerise = $fichier->hashName();
            $pjFile->annotation_arrivee_id = $this->AnnotationPjId;
            $pjFile->save();
            $this->fichier = "";
        }
    }
  
    //$pjFile = new PieceJointeCourrierArrivee();
    

   /* 
    $this->fichier->storeAs('fichier',$fileName);
    $pjFile->pjNumerise = $fileName;*/
    
   // $pjFile->courrier_arrive_id = $this->pjCourrierId;
   // $pjFile->save();

    $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Pièce jointe ajoutée avec succès!"]);
   

    //$this->courrierFileId = $fileCourrier->id;
   }

/*public function addPJ(){ 
    $this->validate([
        'fichier' => 'required|mimes:pdf,docx'
    ]);

    $pj = new PieceJointeAnnotation();
    $fileName = Carbon::now()->timestamp . '.' . $this->fichier->extension();
    $this->fichier->storeAs('fichier',$fileName);

    $pj->pjNumerise = $fileName;
    $pj->annotation_arrivee_id = $this->AnnotationPjId;
    $pj->save();

    $this->fichier = "";

    $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Pièce jointe ajoutée avec succès!"]);
  }*/

public function seePj($id){
    $seepjApercu = PieceJointeAnnotation::find($id);
    $this->seepjApercuId = $seepjApercu->id;
}

public function confirmDeletepj($id){
    $this->dispatchBrowserEvent("showConfirmMessage", ["message" => [
        "text" =>"Vous êtes sur le point de supprimer une pièce jointe. Voulez-vous continuer?",
        "title" => "Êtes-vous sûr de continuer?",
        "type" => "warning",
        "data" =>[
            "pj_id" => $id
        ]
    ]]);
}

public function deletePj($id){
    PieceJointeAnnotation::destroy($id);

     $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Pièce jointe supprimée avec succès!"]);

}

public function suivi($id){
    $annotation = AnnotationArrivee::find($id);
    //$this->courrierIdSuivi = $annotation->courrier_arrive_id;

    $this->courrierIdSuivi = DB::table('user_fonction_courrier')
                      ->join('fonctions', 'user_fonction_courrier.fonction_id', '=', 'fonctions.id')
                      ->join('users', 'user_fonction_courrier.user_id', '=', 'users.id')
                      ->join('annotation_arrivees', 'users.id', '=', 'annotation_arrivees.user_id')
                      ->join('courrier_arrives', 'annotation_arrivees.courrier_arrive_id', '=', 'courrier_arrives.id')
                      ->select('*')
                      ->where('courrier_arrive_id', $annotation->courrier_arrive_id)
                      ->where('user_fonction_courrier.updated_at', $annotation->updated_at)
                      ->where('user_fonction_courrier.annotation_id', $annotation->id)
                      ->where('user_fonction_courrier.user_id', Auth::user()->id)
                      ->get();
    //dump($this->courrierIdSuivi); 

    $this->courrierStat = DB::table('user_fonction_courrier')
    ->join('fonctions', 'user_fonction_courrier.fonction_id', '=', 'fonctions.id')
    ->join('users', 'user_fonction_courrier.user_id', '=', 'users.id')
    ->join('annotation_arrivees', 'users.id', '=', 'annotation_arrivees.user_id')
    ->join('courrier_arrives', 'annotation_arrivees.courrier_arrive_id', '=', 'courrier_arrives.id')
    ->select('*')
    ->where('courrier_arrive_id', $annotation->courrier_arrive_id)
    ->where('user_fonction_courrier.updated_at', $annotation->updated_at)
    ->where('user_fonction_courrier.annotation_id', $annotation->id)
    ->where('user_fonction_courrier.user_id', Auth::user()->id)
    ->get();
    $this->currentPage = PAGESUIVIFORM;
}

}
