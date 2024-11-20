<?php

namespace App\Http\Livewire;

use App\Models\AnnotationArrivee;
use App\Models\CourrierArrive;
use App\Models\detailAnnotation;
use App\Models\Fonction;
use App\Models\PieceJointeAnnotation;
use App\Models\typeAnnotation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Diff\Diff;
use Carbon\Traits\Difference;

class ConsultationComponent extends Component
{
    use WithPagination, WithFileUploads;
    public $courrierId;

    public $userEditId;
    public $CourrierEditId;
    public $AnnotationPjId;

    public $dateAnnotation;
    public $dateSuivie;
    public $numero;
    public $objet;
    public $dateTheorique;
    public $dateReel;
    public $delaiTheorique;
    public $delaiReel;

    public $selectedTypeCourrier;


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

    //Aperçu
    public $dateAnnotationAperçu;
    public $dateSuiviAperçu;
    public $numeroAperçu;
    public $objetAperçu;
    public $dateTheoriqueAperçu;
    public $dateReelAperçu;
    public $delaiTheoriqueAperçu;
    public $delaiReelAperçu;
    public $fichier;
    public $listPjAnnotation;

    public $typefonctionTable = [];
    public $typefonctionEdit = [];

    public $seepjApercuId;
    public $categorieSee;

    public $statut;
    public $annotation_id;
    public $currentPage = PAGELIST;

    public $annotationId;
    public $annotationuser;
    public $annotationdate;
    public $destinataireSee;

    public $observationSee;

    public $courrierIdSuivi;

    public $delai;
    protected $paginationTheme = "bootstrap";
    use WithPagination;
    public function render()
    {
        Carbon::setLocale("fr");
        $data = [
            "courriers" => DB::table('courrier_arrives')
                               ->select('*')
                               ->where('estEnvoyer', '<>', 0)
                               ->where('estAnnoterAgent', '<>', 1)
                               ->get(),
            
        ];

       // $user_id=Auth::user()->id;
       $annotations = AnnotationArrivee::where('user_id', Auth::user()->id)->get();
       /*$annotations = DB::table('user_fonction_courrier')
                         ->join('users', 'users.id', '=', 'user_fonction_courrier.user_id')
                         ->join('annotation_arrivees', 'annotation_arrivees.user_id', '=', 'users.id')
                         ->join('courrier_arrives', 'courrier_arrives.id', '=', 'annotation_arrivees.courrier_arrive_id')
                         ->select('*')
                         ->where('user_fonction_courrier.user_id', Auth::user()->id)
                         ->get();*/
       $pj = PieceJointeAnnotation::where('annotation_arrivee_id', $this->AnnotationPjId)->paginate(5);
       $apercudelaPJ = PieceJointeAnnotation::where('id', $this->seepjApercuId)->get();
       $users = User::where('id', Auth::user()->id)->get();
       //dump($users);
       $fileCourriersAperçu = CourrierArrive::where('id', $this->fileCourrierSeeId)->get();
        return view('livewire.consultation.index', $data, ['annotations' => $annotations, 'pj' => $pj, 'apercudelaPJ' => $apercudelaPJ, 'users' => $users, "fileCourriersAperçu" => $fileCourriersAperçu])->extends("layouts.base")->section("contenu");
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

    public function goToListCourrier(){
        $this->currentPage = PAGELIST;
    }

    public function goToSee($id){
        $courrier = CourrierArrive::find($id);
           $this->selectedTypeCourrier = $courrier->numPrimaire;
           $this->referenceSee =  $courrier->reference;
           $this->categorieSee =  $courrier->categorie;
           $this->enregistrementSee =  $courrier->numEnregistrement;
           $this->objetSee =  $courrier->objet;
           $this->destinataireSee =  $courrier->destinataire;
           $this->observationSee =  $courrier->observation;
           $this->structureSee =  $courrier->structure;
           $this->referencepjSee =  $courrier->referencePJ;
           $this->prioriteSee =  $courrier->priorite;
           $this->expediteurSee =  $courrier->nomExpediteur;
           $this->datearriveSee = date('d-m-Y', strtotime($courrier->dateArrive));
           $this->numeroreponseSee =  $courrier->numReponse;
           $this->pieceSee =  $courrier->nombrePiece;
           $this->emailSee =  $courrier->email;
           //$this->chronoSee =  $courrier->chrono->lib_chrono;
           //$this->natureSee =  $courrier->nature->nom;

          $this->fileCourrierSeeId = $courrier->id;
        $this->currentPage = PAGESEEMOREFORM;
    }

    public function goToAnnote($id){
        $courrier = CourrierArrive::find($id);
        $this->courrierId = $courrier->id;
        $this->numero = $courrier->numPrimaire;
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

    public function updated($fields){
        $this->validateOnly($fields, [
            //'dateSuivie' => 'required',
            'numero' => 'required|numeric',
            'objet' => 'required',
            'dateTheorique' => 'required',
            //'dateReel' => 'required',
            //'delaiTheorique' => 'required',
        ]);
    }
    public function annotation(){
         $this->validate([
            //'dateSuivie' => 'required',
            'numero' => 'required|numeric',
            'objet' => 'required',
            'dateTheorique' => 'required',
            //'dateReel' => 'required',
            //'delaiTheorique' => 'required',
         ]);

         $annotation = new AnnotationArrivee();
         //$user_id = Auth::user()->id;
         $annotation->dateAnnotation = Carbon::now()->toDateTimeString();
         $annotation->dateSuivi = Carbon::now()->toDateTimeString();
         $annotation->numero = $this->numero;
         $annotation->objet = $this->objet;
         $annotation->dateFinTraitementTheorique = $this->dateTheorique;
         //$annotation->dateFinTraitementReel = Carbon::now()->toDateTimeString();
         $annotation->delaiTheorique = 0;
         //$annotation->delaiReel = 0;
         $annotation->courrier_arrive_id = $this->courrierId;
         $annotation->created_at = now()->addHours(1);
         $annotation->updated_at  = Carbon::now()->addHours(1);
         $annotation->user_id = Auth::user()->id;
         $annotation->save();
         $this->effacerChamps();

         $this->annotationId = $annotation->id;
         $this->annotationuser = $annotation->user_id;
         $this->annotationdate = $annotation->created_at;
 
        /* $this->annotation_id = $annotation->id;
         dump($this->annotation_id);
         $anno = AnnotationArrivee::where('id', $this->annotation_id)->get();
         
         $date_annotation = date('Y-m-d', strtotime($anno->dateAnnotation));
         $date_theorique = date('Y-m-d', strtotime($anno->dateFinTraitementTheorique));
         $delaiTheorique = $date_annotation - $date_theorique;
         dump($delaiTheorique); */


         // Requete permettant de mettre estAnnoter à 1
         DB::table('courrier_arrives')->where('estAnnoterAgent', 0)
                ->lazyById()->each(function ($courrier) {
                    DB::table('courrier_arrives')
                       ->where('id', $this->courrierId)
                       ->update(['estAnnoterAgent' => 1]);
                });
        
         //CourrierArrive::find($this->courrierId)->update(["estAnnoter"=> "1"]);
         
         foreach($this->typefonctionTable["types"] as $type){
            if($type["active"]){
                AnnotationArrivee::find($annotation->id)->types()->attach($type["type_id"]);
            }
        }

        foreach($this->typefonctionTable["fonctions"] as $fonction){
            if($fonction["active"]){
                //CourrierArrive::find($this->courrierId)->fonctions()->attach($fonction["fonction_id"]);
                User::find(Auth::user()->id)->fonctions()->attach($fonction["fonction_id"]);
                
            }
        }

        //dump(date('m-d-Y', strtotime($annotation->dateAnnotation)));
        //dump(date('m-d-Y', strtotime($annotation->dateFinTraitementTheorique)));
        //dump();
        //$this->delai = Carbon::parse($annotation->dateAnnotation)->floatDiffInRealDays($annotation->dateFinTraitementTheorique);
        
        DB::table('annotation_arrivees')
           ->where('id', $this->annotationId)
           ->where('user_id', Auth::user()->id)
           ->update(['delaiTheorique' => Carbon::parse($annotation->dateAnnotation)->diffInDays($annotation->dateFinTraitementTheorique)]);
        
           DB::table('annotation_arrivees')
           ->where('id', $this->annotationId)
           ->where('user_id', Auth::user()->id)
           ->update(['statut' => 1]);
   

        DB::table('user_fonction_courrier')
        ->where('user_id', $this->annotationuser)
        ->where('created_at', $this->annotationdate)
        ->update(['annotation_id' => $this->annotationId]);
    
        DB::table('user_fonction_courrier')
           ->where('annotation_id', $this->annotationId)
           ->where('user_id', $this->annotationuser)
           ->where('created_at', $this->annotationdate)
           ->update(['statutenvoie' => 1]);

         //$this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Annotation créée et envoyée avec succès!"]);

        return redirect()->route('directeur.courrierarrive.envoie');
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

    //Exportation de fichier

    /*public function export(){
        $annotation = AnnotationArrivee::find($id); 
        $pj = PieceJointeAnnotation::where('annotation_arrivee_id', $annotation->id)->get();
        return Storage::disk('fichier')->download($pj->pjNumerise);
    }*/


    public function seePj($id){
        $seepjApercu = PieceJointeAnnotation::find($id);
        $this->seepjApercuId = $seepjApercu->id;
    }

}












