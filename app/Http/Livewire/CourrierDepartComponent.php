<?php

namespace App\Http\Livewire;

use App\Models\ChronoCourrierDepart;
use App\Models\CourrierArrive;
use App\Models\CourrierDepart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class CourrierDepartComponent extends Component
{
    use WithFileUploads;
    public $courrierId;
    public $numordre;
    public $piece;
    public $datedepart;
    public $destinataire;
    public $objet;
    public $chrono;
    public $observation;
    public $fichier;
    public $courrierDepartId;
    public $currentPage = PAGELIST;
    protected $paginationTheme = "bootstrap";
    public $addCourrier = [];
    public $search = "";
    public function render()
    {
        Carbon::setLocale("fr");
        return view('livewire.courrierDepart.index', ["chronos" => ChronoCourrierDepart::all(), "courrierdeparts" => CourrierArrive::where('categorie', "Sortant")->latest()->paginate(5)])->extends("layouts.base")->section("contenu");
    }


    public function goToaddCourrier(){
        $this->currentPage = PAGECREATEFORM;
    }

    public function goToListCourrier(){
        $this->currentPage = PAGELIST;
        $this->editCourrier = [];
    }

    public function goToEditCourrierDepart($id){
           $courrierDepart = CourrierArrive::find($id);
           $this->courrierId = $courrierDepart->id;

           $this->numordre = $courrierDepart->numPrimaire;
           $this->destinataire = $courrierDepart->destinataire;
           $this->objet = $courrierDepart->objet;
           $this->chrono = $courrierDepart->chrono->id;
           $this->observation = $courrierDepart->observation;

           $this->currentPage = PAGEEDITFORM;
    }

    public function vider(){
        $this->reset(['numordre','destinataire','objet','chrono','observation']);
    }
    public function updated($fields){
        $this->validateOnly($fields, [
            'numordre' => 'required|numeric|unique:courrier_arrives,numPrimaire',
            'destinataire' => 'required',
            'objet' => 'required',
            'chrono' => 'required',
            'observation' => 'required',
        ]);
    }
    public function addCourrier(){
        $this->validate([
            'numordre' => 'required|numeric|unique:courrier_arrives,numPrimaire',
            'destinataire' => 'required',
            'objet' => 'required',
            'chrono' => 'required',
            'observation' => 'required',
        ]);

        $courrier = new CourrierArrive();
        $courrier->numPrimaire = $this->numordre;
        $courrier->categorie = "Sortant";
        $courrier->destinataire = $this->destinataire;
        $courrier->objet = $this->objet;
        $courrier->observation = $this->observation;
        $courrier->dateDepart = Carbon::now()->toDateTimeString();
        $courrier->chrono_id = $this->chrono;
        
       // $courrier->file_courrier_arrive_id = $this->courrierFileId;

        $imageName = Carbon::now()->timestamp . '.' . $this->fichier->extension();
        $this->fichier->storeAs('fichier',$imageName);
        $courrier->courrierNumerise = $imageName;
        $courrier->save();
        $this->vider();

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Courrier départ ajouté avec succès!"]);
    }
   /* public function updated($fields){
        $this->validateOnly($fields, [
            'numordre' => ['required', 'numeric', 'numOrdre', Rule::unique('courrierdeparts', 'numOrdre')->ignore($this->courrierId)],
            'piece' => 'required',
            'datedepart' => 'required',
            'destinataire' => 'required',
            'objet' => 'required',
            'chrono' => 'required',
            'observation' => 'required',
        ]);
    }*/

    public function editCourrier(){
         $this->validate([
            //'numPrimaire' => ['required', 'numeric', 'numPrimaire', Rule::unique('courrier_arrives', 'numPrimaire')->ignore($this->courrierId)],
            'destinataire' => 'required',
            'objet' => 'required',
            'chrono' => 'required',
            'observation' => 'required',
         ]);

         $courrierdepart = CourrierArrive::find($this->courrierId);
         //dump($courrierdepart);
         $courrierdepart->numPrimaire = $this->numordre;
         $courrierdepart->destinataire = $this->destinataire;
         $courrierdepart->objet = $this->objet;
         $courrierdepart->observation = $this->observation;
         $courrierdepart->chrono_id = $this->chrono;

         $courrierdepart->save();

         $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Courrier départ mis à jour avec succès!"]);
    }

    public function send($id){
        $courrier = CourrierArrive::find($id);
    $this->courrierDepartId = $courrier->id;

    DB::table('courrier_arrives')->where('estEnvoyer', 0)
    ->lazyById()->each(function ($courrier) {
        DB::table('courrier_arrives')
           ->where('id', $this->courrierDepartId)
           ->update(['estEnvoyer' => 1]);
    });
    $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Envoie effectué avec succès!"]);
    }

    public function confirmDelete($id){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" => [
            "text" =>"Vous êtes sur le point de supprimer un courriers de la liste des courriers départs. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            "data" =>[
                "courrier_id" => $id
            ]
        ]]);
    }

    public function deleteUser($id){
        CourrierDepart::destroy($id);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Courrier départ supprimé avec succès!"]);
    }
}













