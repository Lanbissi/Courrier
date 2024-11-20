<?php

namespace App\Http\Livewire;

use App\Models\Chrono;
use App\Models\CourrierArrive;
use App\Models\FileCourrierArrive;
use App\Models\NatureCourrierArrive;
use App\Models\PieceJointeCourrierArrivee;
use Carbon\Carbon;
use Facade\Ignition\Http\Controllers\ScriptController;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\HydrationMiddleware\NormalizeDataForJavaScript;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
                            

class CourrierArriveComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    // add variable
    public $numprimaireAdd;
    public $referenceAdd;
    public $enregistrementAdd;
    public $objetAdd;
    public $structureAdd;
    public $referencepjAdd;
    public $prioriteAdd;
    public $expediteurAdd;
    public $datearriveAdd;
    public $numeroreponseAdd;
    public $datereponseAdd;
    public $datesaisieAdd;
    public $pieceAdd;
    public $emailAdd;
    public $chronoAdd;
    public $natureAdd;
    public $imageAdd = null;
    public $inputFileIterator = 0;
    

    public $courrierFile;
    public $newImage;
    public $courrierFileId = 0;
    public $courrierFileEditId = 0;

    //Edit variable
    public $courrierId;
     public $numprimaire;
     public $reference;
     public $enregistrement;
     public $objet;
     public $structure;
     public $referencepj;
     public $priorite;
     public $expediteur;
     public $datearrive;
     public $numeroreponse;
     public $piece;
     public $email;
     public $chrono;
     public $nature;
     public $newImageEdit;

     //Variable pour gérer les aperçus courrier
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
     

     public $fichier = [];
     public $file_id;

     public $files_id;

     public $fileCourrierSeeId;
     public $selectedTypeCourrier;
     public $courrierEnvoyerId;
     public $pjCourrierNum;
     public $pjCourrierId;
    public $seepjApercuCourrierArrive_id;

    public $currentPage = PAGELIST;
    protected $paginationTheme = "bootstrap";
    public $search = "";
    public function render()
    {
        //$this->datearriveAdd = date("d/m/Y");
        
        Carbon::setLocale("fr");
        $files = FileCourrierArrive::where('id', $this->files_id)->get();
        $fileCourriers = FileCourrierArrive::where('id', $this->courrierFileId)->get();
        $fileCourriersEdit = FileCourrierArrive::where('id', $this->courrierFileEditId)->get();

        //Requête  pour aperçu image
        $fileCourriersAperçu = CourrierArrive::where('id', $this->fileCourrierSeeId)->get();
        //Requête pour afficher les pj
        $pj = PieceJointeCourrierArrivee::where('courrier_arrive_id', $this->pjCourrierId)->get();
        //Requête aperçu pièce jointe courrier arrivé
        $pjAperçu = PieceJointeCourrierArrivee::where('id', $this->seepjApercuCourrierArrive_id)->get();
        
        return view('livewire.courrierArrive.index', ["courrierArrives" => CourrierArrive::where('categorie', "Entrant")->latest()->paginate(5), "chronos" => Chrono::all(), "natures" => NatureCourrierArrive::all(), "fileCourriers" => $fileCourriers, "files" => $files, "fileCourriersEdit" => $fileCourriersEdit, "fileCourriersAperçu" => $fileCourriersAperçu, "pj" => $pj, "pjAperçu" => $pjAperçu])->extends("layouts.base")->section("contenu");
    }

   
    public function goToaddCourrier(){
        $this->currentPage = PAGECREATEFORM;
    }

    public function goToListCourrier(){
        $this->currentPage = PAGELIST;
    }

    public function vider(){
        $this->reset(['numprimaireAdd','referenceAdd','enregistrementAdd','objetAdd','structureAdd','referencepjAdd','prioriteAdd','expediteurAdd','datearriveAdd','numeroreponseAdd','pieceAdd','emailAdd','chronoAdd','natureAdd','courrierFileId']);
    }


    public function controleChamps($fields){
        $this->validateOnly($fields, [
            'numprimaireAdd' => 'required|numeric|unique:courrier_arrives,numPrimaire',
            'referenceAdd' => 'required',
            'enregistrementAdd' => 'required|numeric|unique:courrier_arrives,numEnregistrement',
            'objetAdd' => 'required',
            'structureAdd' => 'required',
            'referencepjAdd' => 'required',
            'prioriteAdd' => 'required',
            'expediteurAdd' => 'required',
            'datearriveAdd' => 'required',
            'numeroreponseAdd' => 'required',
            'pieceAdd' => 'required',
            'emailAdd' => 'required|email',
            'chronoAdd' => 'required',
            'natureAdd' => 'required',
            'imageAdd' => 'required',
        ]);
    }
    public function addCourrier(){
        $this->validate([
            'numprimaireAdd' => 'required|numeric|unique:courrier_arrives,numPrimaire',
            'referenceAdd' => 'required',
            'enregistrementAdd' => 'required|numeric|unique:courrier_arrives,numEnregistrement',
            'objetAdd' => 'required',
            'structureAdd' => 'required',
            'referencepjAdd' => 'required',
            'prioriteAdd' => 'required',
            'expediteurAdd' => 'required',
            'datearriveAdd' => 'required',
            'numeroreponseAdd' => 'required',
            'pieceAdd' => 'required',
            'emailAdd' => 'required|email',
            'chronoAdd' => 'required',
            'natureAdd' => 'required',
            'imageAdd' => 'required',
        ]);

        $courrier = new CourrierArrive();
        $courrier->numPrimaire = $this->numprimaireAdd;
        $courrier->reference = $this->referenceAdd;
        $courrier->numEnregistrement = $this->enregistrementAdd;
        $courrier->objet = $this->objetAdd;
        $courrier->structure = $this->structureAdd;
        $courrier->referencePJ = $this->referencepjAdd;
        $courrier->priorite = $this->prioriteAdd;
        $courrier->nomExpediteur = $this->expediteurAdd;
        $courrier->dateArrive = $this->datearriveAdd;
        $courrier->numReponse = $this->numeroreponseAdd;
        $courrier->dateReponse = Carbon::now()->toDateTimeString();
        $courrier->dateSaisi = Carbon::now()->toDateTimeString();
        $courrier->nombrePiece = $this->pieceAdd;
        $courrier->email = $this->emailAdd;
        $courrier->chrono_id = $this->chronoAdd;
        $courrier->nature_courrier_arrive_id = $this->natureAdd;
        $courrier->categorie = "Entrant";
       // $courrier->file_courrier_arrive_id = $this->courrierFileId;

        $imageName = Carbon::now()->timestamp . '.' . $this->imageAdd->extension();
        $this->imageAdd->storeAs('fichier',$imageName);
        $courrier->courrierNumerise = $imageName;
        $courrier->save();
        //$this->effacerChamps();
        $this->vider();
        $this->imageAdd = null;
        $this->inputFileIterator++;
        
        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Courrier ajouté avec succès!"]);
        
    }

    public function goToEditCourrierArrive($courrierId){
        $courrier = CourrierArrive::with("chrono", "nature")->find($courrierId);
        $this->courrierId = $courrier->id;
        $this->numprimaire = $courrier->numPrimaire;
        $this->reference = $courrier->reference;
        $this->enregistrement = $courrier->numEnregistrement;
        $this->objet = $courrier->objet;
        $this->structure = $courrier->structure;
        $this->referencepj = $courrier->referencePJ;
        $this->priorite = $courrier->priorite;
        $this->expediteur = $courrier->nomExpediteur;
        $this->datearrive =  date('d-m-Y', strtotime($courrier->dateArrive));
        $this->numeroreponse = $courrier->numReponse;
        //$this->datereponse = Carbon::now()->toDateTimeString();
        //$this->datesaisie = Carbon::now()->toDateTimeString();
        $this->piece = $courrier->nombrePiece;
        $this->email = $courrier->email;
        $this->chrono = $courrier->chrono->id;
        $this->nature = $courrier->nature->id;
        $this->newImageEdit = $courrier->courrierNumerise;

        $this->currentPage = PAGEEDITFORM;

        //$this->files_id = $courrier->file_courrier_arrive_id;
        //$this->courrierFileEditId = $courrier->file_courrier_arrive_id;
        //dump($this->courrierFileEditId);
    }

    public function updated($fields){
        $this->validateOnly($fields, [
            //'numprimaire' => 'required|numeric|unique:courrier_arrives,numPrimaire',
            'reference' => 'required',
            //'enregistrement' => 'required|numeric|unique:courrier_arrives,numEnregistrement',
            'objet' => 'required',
            'structure' => 'required',
            'referencepj' => 'required',
            'priorite' => 'required',
            'expediteur' => 'required',
            'datearrive' => 'required',
            'numeroreponse' => 'required',
            //'datereponse' => 'required',
            //'datesaisie' => 'required',
            'piece' => 'required',
            'email' => 'required|email',
            'chrono' => 'required',
            'nature' => 'required',
        ]);

        if ($this->newImageEdit) 
        {
            $this->validateOnly($fields,[
                'newImageEdit' => 'required|mimes:pdf'
            ]);   
        }
    }

    public function editCourrier(){
        $this->validate([
            //'numprimaire' => 'required|numeric|unique:courrier_arrives,numPrimaire',
            'reference' => 'required',
            //'enregistrement' => 'required|numeric|unique:courrier_arrives,numEnregistrement',
            'objet' => 'required',
            'structure' => 'required',
            'referencepj' => 'required',
            'priorite' => 'required',
            'expediteur' => 'required',
            'datearrive' => 'required',
            'numeroreponse' => 'required',
            //'datereponse' => 'required',
            //'datesaisie' => 'required',
            'piece' => 'required',
            'email' => 'required|email',
            'chrono' => 'required',
            'nature' => 'required',
        ]);

        if ($this->newImageEdit) {
            $this->validate([
                'newImageEdit' => 'required|mimes:pdf' 
            ]);
        }

        $courrier = CourrierArrive::find($this->courrierId);
    
        $courrier->numPrimaire = $this->numprimaire;
        $courrier->reference = $this->reference;
        $courrier->numEnregistrement = $this->enregistrement;
        $courrier->objet = $this->objet;
        $courrier->structure = $this->structure;
        $courrier->referencePJ = $this->referencepj;
        $courrier->priorite = $this->priorite;
        $courrier->nomExpediteur = $this->expediteur;
        $courrier->dateArrive = date('Y-m-d',  strtotime($this->datearrive)) ;
        $courrier->numReponse = $this->numeroreponse;
       // $courrier->dateReponse = $this->datereponse;
        //$courrier->dateSaisi = $this->datesaisie;
        $courrier->nombrePiece = $this->piece;
        $courrier->email = $this->email;
        $courrier->chrono->id = $this->chrono;
        $courrier->nature->id = $this->nature;
        $courrier->categorie = "Entrant";
        //$courrier->file_courrier_arrive_id = $this->courrierFileEditId;
        if ($this->newImageEdit) {
            unlink('fichier/fichier/'.$courrier->courrierNumerise);
            $imageName = Carbon::now()->timestamp . '.' . $this->newImageEdit->extension();
            $this->newImageEdit->storeAs('fichier',$imageName);
            $courrier->courrierNumerise = $imageName;  
        }

        $courrier->save();
        $this->effacerChamps();
       
        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Courrier mis à jour avec succès!"]);

    }

    public function confirmDelete($name, $id){
        $this->dispatchBrowserEvent("showConfirmMessageCourrier", ["message" => [
            "text" =>"Vous êtes sur le point de supprimer $name de la liste des courriers. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            "data" =>[
                "courrier_id" => $id
            ]
        ]]);
    }

    public function deleteCourrier($id){
        CourrierArrive::destroy($id);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Courrier supprimé avec succès!"]);
   }

   //Pièce jointe méthode
   public function goToAddpj($id){
    $courrierArrive = CourrierArrive::find($id);
    $this->pjCourrierNum = $courrierArrive->numPrimaire;
    $this->pjCourrierId = $courrierArrive->id;
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

            $pjFile = new PieceJointeCourrierArrivee();
            $pjFile->pjNumerise = $fichier->hashName();
            $pjFile->courrier_arrive_id = $this->pjCourrierId;
            $pjFile->save();
        }
    }
  
    $pjFile = new PieceJointeCourrierArrivee();
    

   /* 
    $this->fichier->storeAs('fichier',$fileName);
    $pjFile->pjNumerise = $fileName;*/
    
   // $pjFile->courrier_arrive_id = $this->pjCourrierId;
   // $pjFile->save();

    $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Pièce jointe ajoutée avec succès!"]);
    $this->fichier = "";

    //$this->courrierFileId = $fileCourrier->id;
   }

   public function addfile(){
    $this->validate([
        'courrierFile' => 'required'
    ]);
  
    $fileCourrier = new FileCourrierArrive();
    $fileName = Carbon::now()->timestamp . '.' . $this->courrierFile->extension();
    $this->courrierFile->storeAs('fichier',$fileName);
  
    $fileCourrier->fileName = $fileName;
    $fileCourrier->save();

    $this->courrierFile = "";

    $this->courrierFileId = $fileCourrier->id;
    
      
   }

  public function editfile(){
    /*$this->validate([
        'newImage' => 'required'
    ]);
  
    $fileCourrier = new FileCourrierArrive();

    if ($this->newImage) {
        $fileName = Carbon::now()->timestamp . '.' . $this->newImage->extension();
        $this->newImage->storeAs('fichier',$fileName);
        $fileCourrier->fileName = $fileName;
    }

    $fileCourrier->save();

    $this->newImage = "";

    $this->courrierFileEditId = $fileCourrier->id;
    //dump($this->courrierFileEditId);*/
   }

   //Fonction permettant de  visualiser un courrier
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

   //fonction pour valider l'envoie au directeur
   public function send($id){
    $courrier = CourrierArrive::find($id);
    $this->courrierEnvoyerId = $courrier->id;

    DB::table('courrier_arrives')->where('estEnvoyer', 0)
    ->lazyById()->each(function ($courrier) {
        DB::table('courrier_arrives')
           ->where('id', $this->courrierEnvoyerId)
           ->update(['estEnvoyer' => 1]);
    });
    $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Envoie effectué avec succès!"]);
    //CourrierArrive::find($id)->update($validateAttributes["editUser"]);
   }


   //Confirm delete PJ
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

  //Delete PJ
  public function deletepj($id){
    PieceJointeCourrierArrivee::destroy($id);

    $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Pièce jointe supprimé avec succès!"]);
  }

  //See Pj
  public function seePj($id){
        $seepjApercuCourrierArrive = PieceJointeCourrierArrivee::find($id);
        $this->seepjApercuCourrierArrive_id = $seepjApercuCourrierArrive->id;
  }

}












