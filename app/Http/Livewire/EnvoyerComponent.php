<?php

namespace App\Http\Livewire;

use App\Models\AnnotationArrivee;
use App\Models\Fonction;
use App\Models\PieceJointeAnnotation;
use App\Models\typeAnnotation;
use App\Models\User;
use App\Models\UserFonctionCourrier;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class EnvoyerComponent extends Component
{
    use WithPagination, WithFileUploads;
    public $typefonctionEdit = [];
    public $currentPage = PAGELIST;
    public $AnnotationEditId;
    public $CourrierEditId;
    public $statut=0;

    public $numeroEdit;
    public $objetEdit;
    public $dateTheoriqueEdit;
    public $userEditId;

    public $selectedTypeCourrier;
    public $dateAnnotationAperçu;
    public $dateSuiviAperçu;
    public $numeroAperçu;
    public $objetAperçu;
    public $dateTheoriqueAperçu;
    public $dateReelAperçu;
    public $delaiTheoriqueAperçu;
    public $delaiReelAperçu;

    public $AnnotationPjId;
    public $listPjAnnotation;
    public $seepjApercuId;
    public $fichier;

    public $courrierSuiviNumPrimaire;

    public $courrierIdSuivi;
    public $annotationEnvoyerId;
    public $delai;
    public $annotationcreate;

    public $annotationuser;
    public $courrierStat;

    protected $mapForCB1;
    //public $value = [];
    public $fonctionsIds = [];

    public $dateAnnotations;

    public $req;
    
    protected $paginationTheme = "bootstrap";
    public function render()
    {
        Carbon::setLocale("fr");
        $annotations = AnnotationArrivee::where('user_id', Auth::user()->id)->latest()->paginate(5);
        //dump($annotations);
        $pj = PieceJointeAnnotation::where('annotation_arrivee_id', $this->AnnotationPjId)->paginate(5);
        $apercudelaPJ = PieceJointeAnnotation::where('id', $this->seepjApercuId)->get();
        return view('livewire.envoie.index', ['annotations' => $annotations, 'pj' => $pj, 'apercudelaPJ' => $apercudelaPJ])->extends("layouts.base")->section("contenu");
    }

    public function goToListCourrier(){
        $this->currentPage = PAGELIST;
    }

    public function goToEditAnnote($id){
        $Annotation = AnnotationArrivee::find($id);
        //dump($Annotation);
        $this->AnnotationEditId = $Annotation->id;
        $this->userEditId = $Annotation->user_id;
        $this->CourrierEditId = $Annotation->courrier_arrive_id;
        
        $this->numeroEdit = $Annotation->numero;
        $this->objetEdit = $Annotation->objet;
        $this->dateTheoriqueEdit = date('Y-m-d', strtotime($Annotation->dateFinTraitementTheorique));
        $this->AnnotationEditId = $Annotation->id;

        $this->currentPage = PAGEEDITFORM;

        //$this->typeFonctionEdit();

        $this->typefonctionEdit["types"] = [];
        $this->typefonctionEdit["fonctions"] = [];

        $mapForCB = function($value){
            return $value["id"];
        };

         $mapForCB1 = function($n){
            return $n;
        };

        $req1 = AnnotationArrivee::find($this->AnnotationEditId);

        $typeIds = array_map($mapForCB, $req1->types->toArray());

        $fonctionIds = array_map($mapForCB, User::find($this->userEditId)->fonctions()
        ->where('user_fonction_courrier.created_at', $Annotation->created_at)
        ->where('user_fonction_courrier.user_id', $this->userEditId)
        ->get()->toArray()
       );
        //dump($typeIds);

        /*$req = array(DB::table('user_fonction_courrier')
        ->select('fonction_id')
        ->where('created_at', $Annotation->created_at)
        ->where('user_id', $this->userEditId)
        ->get());

        $new_array = array_map($mapForCB1, $req);
        dump($new_array);
           
        DB::table('user_fonction_courrier')
                ->select('fonction_id')
                ->where('created_at', $Annotation->created_at)
                ->where('user_id', $this->userEditId)
                ->get();*/
        
        //$result = json_decode($req, true);
        //$fonctionsIds = array_map($mapForCB, $result);
        //var_dump($result['function_id']);
        //dump($fonctionsIds);
        /*$fonctionsIds = array_map($mapForCB, DB::table('user_fonction_courrier')
                ->select('fonction_id')
                ->where('created_at', $Annotation->created_at)
                ->where('user_id', $this->userEditId)
                ->get()->toArray());
        dump($fonctionsIds);*/

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

      /*public function typeFonctionEdit(){
      $this->typefonctionEdit["types"] = [];
      $this->typefonctionEdit["fonctions"] = [];

      $mapForCB = function($value){
          return $value["id"];
      };

      $typeIds = array_map($mapForCB, AnnotationArrivee::find($this->AnnotationEditId)->types->toArray());
      $fonctionIds = array_map($mapForCB, User::find($this->userEditId)->fonctions->toArray());
        //dump($fonctionIds);
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
  }*/

 /* public function mount($fields){
        $this->validateOnly($fields, [
             'dateAnnotationEdit' => 'required',
             'dateSuivieEdit' => 'required',
             'numeroEdit' => 'required|numeric',
             'objetEdit' => 'required',
             'dateTheoriqueEdit' => 'required',
             'dateReelEdit' => 'required',
             'delaiTheoriqueEdit' => 'required',
             'delaiReelEdit' => 'required',
        ]);
  }*/

  public function annotationEdit(){
        $this->validate([
          //'dateAnnotationEdit' => 'required',
         // 'dateSuivieEdit' => 'required',
          'numeroEdit' => 'required|numeric',
          'objetEdit' => 'required',
          'dateTheoriqueEdit' => 'required',
          //'dateReelEdit' => 'required',
          //'delaiTheoriqueEdit' => 'required',
          //'delaiReelEdit' => 'required'
        ]);

       

        $annotation = AnnotationArrivee::find($this->AnnotationEditId);
        //dump($annotation);
        
        $annotation->dateAnnotation = Carbon::now()->toDateTimeString();
        $annotation->dateSuivi = Carbon::now()->toDateTimeString();
        $annotation->numero = $this->numeroEdit;
        $annotation->objet = $this->objetEdit;
        $annotation->dateFinTraitementTheorique = $this->dateTheoriqueEdit;
        $annotation->courrier_arrive_id = $this->CourrierEditId;
        $annotation->updated_at = Carbon::now()->addHours(1);
        $annotation->created_at = Carbon::now()->addHours(1);
        $annotation->user_id  = Auth::user()->id;
        $annotation->statut = $this->statut;
        $annotation->save();
        
        DB::table("arrive_type")->where("annotation_arrivee_id", $annotation->id)->delete();
        DB::table("user_fonction_courrier")
        ->where("user_id", $annotation->user_id)
        ->where("annotation_id", $annotation->id)
        ->where("updated_at", $annotation->updated_at)
        ->delete();

        foreach($this->typefonctionEdit["types"] as $type){
            if($type["active"]){
                AnnotationArrivee::find($this->AnnotationEditId)->types()->attach($type["type_id"]);
            }
        }

        foreach($this->typefonctionEdit["fonctions"] as $fonction){
            if($fonction["active"]){
                //CourrierArrive::find($this->CourrierEditId)->fonctions()->attach($fonction["fonction_id"]);
                User::find($this->userEditId)->fonctions()->attach($fonction["fonction_id"]);
            }
        }

          DB::table('annotation_arrivees')
           ->where('id', $annotation->id)
           ->where('user_id', Auth::user()->id)
           ->update(['delaiTheorique' => Carbon::parse($annotation->dateAnnotation)->diffInDays($annotation->dateFinTraitementTheorique)]);

           DB::table('user_fonction_courrier')
           ->where('user_id', $annotation->user_id)
           ->where('created_at', $annotation->updated_at)
           ->update(['annotation_id' => $annotation->id]);
       
           DB::table('user_fonction_courrier')
              ->where('annotation_id', $annotation->id)
              ->where('user_id', $annotation->user_id)
              ->where('created_at', $annotation->updated_at)
              ->update(['statutenvoie' => 1]);   

        //$this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Annotation mis à jour avec succès!"]);
        return redirect()->route('directeur.courrierarrive.envoie');
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

public function seePj($id){
    $seepjApercu = PieceJointeAnnotation::find($id);
    $this->seepjApercuId = $seepjApercu->id;
}

public function suivi($id){
    $annotation = AnnotationArrivee::find($id);
    //$this->courrierIdSuivi = $annotation->courrier_arrive_id;
    //dump($annotation); 

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
    //dump($this->courrierStat);
}


/*public function send($id){
    $annotation = AnnotationArrivee::find($id);
    $this->annotationEnvoyerId = $annotation->id;
    $this->annotationuser = $annotation->user_id;
    $this->annotationcreate = $annotation->created_at;
    
        DB::table('user_fonction_courrier')
           ->where('annotation_id', $this->annotationEnvoyerId)
           ->where('user_id', $this->annotationuser)
           ->where('created_at', $this->annotationcreate)
           ->update(['statutenvoie' => 1]);

    $this->delai = Carbon::parse($annotation->dateAnnotation)->floatDiffInDays($annotation->dateFinTraitementTheorique);
    //dump($this->delai);

    
        DB::table('annotation_arrivees')
           ->where('id', $this->annotationEnvoyerId)
           ->where('user_id', Auth::user()->id)
           ->update(['delaiTheorique' => $this->delai]);
    
    $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Envoie effectué avec succès!"]);
    //CourrierArrive::find($id)->update($validateAttributes["editUser"]);
   }*/

}



