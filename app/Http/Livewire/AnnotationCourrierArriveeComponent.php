<?php

namespace App\Http\Livewire;

use App\Models\AnnotationArrivee;
use App\Models\CourrierArrive;
use App\Models\FileCourrierArrive;
use App\Models\Fonction;
use App\Models\PieceJointeAnnotation;
use App\Models\typeAnnotation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AnnotationCourrierArriveeComponent extends Component
{
    public $numeroApercu;
    public $referenceApercu;
    public $numEnregistrementAperçu;
    public $objetAperçu;
    public $structureAperçu;
    public $refpjAperçu;
    public $prioriteAperçu;
    public $consigneCourrier;
    

    public $dateAnnotation;
    public $dateSuivie;
    public $numero;
    public $objet;
    public $dateTheorique;
    public $dateReel;
    public $delaiTheorique;
    public $delaiReel;

    public $courrierId;

    // variable aperçu courrier arrivé
    public $numprimaireSee;
     public $referenceSee;
     public $enregistrementSee;
     public $objetSee;
     public $structureSee;
     public $referencepjSee;
     public $prioriteSee;
     public $expediteurSee;
     public $datearriveSee;
     public $numeroreponseSee;
     public $pieceSee;
     public $emailSee;
     public $chronoSee;
     public $natureSee;
     public $fileCourrierSeeId;

    
    public $fichier;
    public $listPjAnnotation;


    public $AnnotationEditId;
    public $CourrierEditId;
    public $dateAnnotationEdit;
    public $dateSuivieEdit;
    public $numeroEdit;
    public $objetEdit;
    public $dateTheoriqueEdit;
    public $dateReelEdit;
    public $delaiTheoriqueEdit;
    public $delaiReelEdit;

    public $typefonctionTable = [];
    public $selectedTypeCourrier;

    public $currentPage = PAGELIST;
    public $courrierIdSuivi;

    public $AnnotationPjId;
    public $userEditId;

    public $dateAnnotationAperçu;
    public $dateSuiviAperçu;
    public $numeroAperçu;
    public $objetAnnotationAperçu;
    public $dateTheoriqueAperçu;
    public $dateReelAperçu;
    public $delaiTheoriqueAperçu;
    public $delaiReelAperçu;

    public $annotationId;
    public $annotationuser;

    public $annotationEnvoyerId;
    public $annotationcreate;

    public $userSenderId;
    public $user_id;

    public $courrierIdFin;

    public $annot_id;
    public $date;
    public $dateannot;
    public $annot_idFin;
    public $user_idFin;


    public $takeServie;
    protected $paginationTheme = "bootstrap";
    public function render()
    {
        Carbon::setLocale("fr");

         $val =  User::where('id', Auth::user()->id)->first();
         $id = $val->fonction_id;
         //dump($id);
         //dump(Auth::user()->service->id);

         $data = [
           "courriers" => DB::table('user_fonction_courrier')->distinct()
            ->join('fonctions', 'user_fonction_courrier.fonction_id', '=', 'fonctions.id')
            ->join('users', 'user_fonction_courrier.user_id', '=', 'users.id')
            ->join('annotation_arrivees', 'users.id', '=', 'annotation_arrivees.user_id')
            ->join('courrier_arrives', 'annotation_arrivees.courrier_arrive_id', '=', 'courrier_arrives.id')
            ->select('courrier_arrives.id', 'courrier_arrives.numPrimaire', 'courrier_arrives.categorie', 'annotation_arrivees.dateFinTraitementTheorique', 'annotation_arrivees.delaiTheorique', 'nom')
            ->where('user_fonction_courrier.fonction_id', Auth::user()->service->id)
            ->where('user_fonction_courrier.statutenvoie', '=',1)
            ->where('user_fonction_courrier.envoyerautreagent','=', 0)
            ->where('statut', '=', 1)
            ->get(),
         ] ;

         //dump(Auth::user()->service->id);

         $fileCourriersAperçu = CourrierArrive::where('id', $this->fileCourrierSeeId)->get();
        
        //dump(Auth::user()->service->id);
        /*$pj = PieceJointeAnnotation::table('piece_jointe_annotations')
                                ->join('annotation_arrivees', 'annotation_arrivees.id', '=', 'piece_jointe_annotations.annotation_arrivee_id')
                                ->select('*')
                                ->where('user_id', Auth::user()->id)->get(); */
        //dump($data);
        return view('livewire.annotation.index', $data, ["fileCourriersAperçu" => $fileCourriersAperçu])->extends("layouts.base")->section("contenu");
    }

    public function effacerChamps(){
        $this->dateAnnotation = "";
        $this->dateSuivie = "";
        $this->numero = "";
        $this->objet = "";
        $this->dateTheorique = "";
        $this->dateReel = "";
        $this->delaiTheorique = "";
        $this->delaiReel = "";
    }

    public function goToSee($id){
           $courrier = CourrierArrive::find($id);
           $this->selectedTypeCourrier = $courrier->numPrimaire;
           $this->referenceSee =  $courrier->reference;
           $this->enregistrementSee =  $courrier->numEnregistrement;
           $this->objetSee =  $courrier->objet;
           $this->structureSee =  $courrier->structure;
           $this->referencepjSee =  $courrier->referencePJ;
           $this->prioriteSee =  $courrier->priorite;
           $this->expediteurSee =  $courrier->nomExpediteur;
           $this->datearriveSee = date('d-m-Y', strtotime($courrier->dateArrive));
           $this->numeroreponseSee =  $courrier->numReponse;
           $this->pieceSee =  $courrier->nombrePiece;
           $this->emailSee =  $courrier->email;
           $this->chronoSee =  $courrier->chrono->lib_chrono;
           $this->natureSee =  $courrier->nature->nom;

          $this->fileCourrierSeeId = $courrier->id;
          //dump($this->fileCourrierSeeId);
          $this->currentPage = PAGESEEMOREFORM;
    }

    public function goToListCourrier(){
        $this->currentPage = PAGELIST;
    }

    public function consigne($id){
        $courrier = CourrierArrive::find($id);
        $this->consigneCourrier = DB::table('arrive_type')
                        ->join('type_annotations', 'type_annotations.id', '=', 'arrive_type.type_annotation_id')
                        ->join('annotation_arrivees', 'annotation_arrivees.id', '=', 'arrive_type.annotation_arrivee_id')
                        ->join('courrier_arrives', 'courrier_arrives.id', '=', 'annotation_arrivees.courrier_arrive_id')
                        ->select('*')
                        ->where('courrier_arrive_id', $courrier->id)
                        ->get();
        
       
         $this->currentPage = PAGECONSIGNE;
    }

    public function  goToAnnote($id){
        $courrier = CourrierArrive::find($id);
        $this->courrierId = $courrier->id;
        $this->numero = $courrier->numPrimaire;
        

        $users = AnnotationArrivee::where('courrier_arrive_id', $this->courrierId)->first();
        $this->user_id = $users->user_id;

        $this->annot_id = $users->id;
        $this->date = $users->created_at;
        $this->dateannot = $users->dateAnnotation;

        $annotation = DB::table('annotation_arrivees')
                        ->where('courrier_arrive_id', $this->courrierId)
                        ->where('user_id', $this->user_id)
                        ->select('*')
                        ->first();
        //dump($annotation);                  
        //$this->annotationEnvoyerId = $annotation->id;
        //$this->annotationuser = $annotation->user_id;
        //dump($this->annotationuser);
        //$this->annotationcreate = $annotation->created_at;
        //dump($this->annotationcreate);
        //dump($this->annotationcreate);
        $this->currentPage = PAGECREATEFORM;
       
        $this->typefonction();
    }

    public function typefonction(){
        $this->typefonctionTable["types"] = [];
        $this->typefonctionTable["fonctions"] = [];
 
        foreach (typeAnnotation::all() as $type) {
             array_push($this->typefonctionTable["types"], ["type_id"=>$type->id, "nom_annotation"=>$type->libAnnotation, "active"=>false]);
        }
 
        foreach (Fonction::all() as $fonction) {
         array_push($this->typefonctionTable["fonctions"], ["fonction_id"=>$fonction->id, "nom_fonction"=>$fonction->code_fonction, "active"=>false]);
       }
    } 

    public function annotation(){
        $this->validate([
            //'dateAnnotation' => 'required',
            //'dateSuivie' => 'required',
            'numero' => 'required|numeric',
            'objet' => 'required',
            'dateTheorique' => 'required',
            //'dateReel' => 'required',
            //'delaiTheorique' => 'required',
            //'delaiReel' => 'required',
         ]);

         $annotation = new AnnotationArrivee();
         //$user_id = Auth::user()->id;
         $annotation->dateAnnotation = Carbon::now()->toDateTimeString();
         $annotation->dateSuivi = Carbon::now()->toDateTimeString();
         $annotation->numero = $this->numero;
         $annotation->objet = $this->objet;
         $annotation->dateFinTraitementTheorique =  $this->dateTheorique;
         //$annotation->dateFinTraitementReel = $this->dateReel;
         $annotation->delaiTheorique = 0;
        // $annotation->delaiReel = $this->delaiReel;
         $annotation->courrier_arrive_id = $this->courrierId;
         $annotation->created_at = $annotation->created_at = now()->addHours(1);;
         $annotation->user_id = Auth::user()->id;
         $annotation->save();

        
         //CourrierArrive::find($this->courrierId)->update(["estAnnoter"=> "1"]);
         
         foreach($this->typefonctionTable["types"] as $type){
            if($type["active"]){
                AnnotationArrivee::find($annotation->id)->types()->attach($type["type_id"]);
            }
        }

        foreach($this->typefonctionTable["fonctions"] as $fonction){
            if($fonction["active"]){
                //CourrierArrive::find($this->courrierId)->fonctions()->attach($fonction["fonction_id"]);
                User::find($annotation->user_id)->fonctions()->attach($fonction["fonction_id"]);
            }
        }

        $this->annotationEnvoyerId = $annotation->id;
        $this->annotationuser = $annotation->user_id;
        $this->annotationcreate = $annotation->created_at;

        DB::table('user_fonction_courrier')
        ->where('user_id', $this->annotationuser)
        ->where('created_at', $this->annotationcreate)
        ->update(['annotation_id' => $this->annotationEnvoyerId]);

        DB::table('user_fonction_courrier')
        ->where('user_id', $this->annotationuser)
        ->where('created_at', $this->annotationcreate)
        ->where('annotation_id', $this->annotationEnvoyerId)
        ->update(['statutenvoie' => 1]);

        //Actualiser date d'annotation théorique autre agent
        DB::table('annotation_arrivees')
           ->where('id', $annotation->id)
           ->where('user_id', Auth::user()->id)
           ->where('created_at', $annotation->created_at)
           ->update(['delaiTheorique' => Carbon::parse($annotation->dateAnnotation)->diffInDays($annotation->dateFinTraitementTheorique)]);

           DB::table('annotation_arrivees')
           ->where('user_id', $this->user_id)
           ->where('courrier_arrive_id', $this->courrierId)
           ->where('id', $this->annot_id)
           ->update(['statut' => 2]);

        //Pour suivre
           /* DB::table('user_fonction_courrier')
            ->where('annotation_id', $this->annot_id)
            ->where('created_at', $this->date)
            ->where('user_id', $this->user_id)
            ->update(['dateFinReel' => Carbon::now()]);

            $donnee = DB::table('user_fonction_courrier')
            ->select('*')
            ->where('annotation_id', $this->annot_id)
            ->where('created_at', $this->date)
            ->where('user_id', $this->user_id)
            ->first();

            DB::table('user_fonction_courrier')
            ->where('annotation_id', $this->annot_id)
            ->where('created_at', $this->date)
            ->where('user_id', $this->user_id)
            ->update(['delaiReel' => Carbon::parse($this->dateannot)->diffInDays($donnee->dateFinReel)]);

            DB::table('user_fonction_courrier')
            ->where('annotation_id', $this->annot_id)
            ->where('created_at', $this->date)
            //->where('user_id', $this->user_id)
            ->where('fonction_id', Auth::user()->service->id)
            ->update(['envoyerautreagent' => 1]);*/

            return redirect()->route('employer.annotation.envoie');
            //$this->effacerChamps();

    }

   public function mettreFin($id){

        $courrier = CourrierArrive::find($id);
        $this->courrierIdFin = $courrier->id;

        $users = AnnotationArrivee::where('courrier_arrive_id', $this->courrierIdFin)->first();
        $this->user_idFin = $users->user_id;
        $this->annot_idFin = $users->id;
        
        DB::table('annotation_arrivees')
        ->where('user_id', $this->user_idFin)
        ->where('courrier_arrive_id', $this->courrierIdFin)
        ->where('id', $this->annot_idFin)
        ->update(['statut' => 2]);

        return redirect()->route('employer.annotation.envoie');
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
                          ->where('user_fonction_courrier.user_id', Auth::user()->id)
                          ->get();
    $this->currentPage = PAGESUIVIFORM;
}


public function goToAddpj($id){
    $annotation = AnnotationArrivee::find($id); 
    $this->AnnotationPjId = $annotation->id;
    $this->listPjAnnotation = PieceJointeAnnotation::where('annotation_arrivee_id', $this->AnnotationPjId)->get();
    //dump($this->listPjAnnotation->annotationarrivee->pjNumerise);
    $this->currentPage = PAGEPJFORM;
}

public function addPJ(){
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
}

public function confirmDelete($id){
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



}









