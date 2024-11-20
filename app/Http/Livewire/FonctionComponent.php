<?php

namespace App\Http\Livewire;

use App\Models\Direction;
use App\Models\Fonction;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class FonctionComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    
    public $fonction_id;
    public $code;
    public $libelle;
    public $direction;
    public function render()
    {
        Carbon::setLocale("fr");
        return view('livewire.fonction.index', ["fonctions" =>Fonction::latest()->paginate(5), "directions" => Direction::all()])->extends("layouts.base")->section("contenu");
    }

    public function updated($fields){
        $this->validateOnly($fields, [
           'code' => 'required',
           'libelle' => 'required',
           'direction' => 'required',
        ]);
    }

    public function addFonction(){
         $this->validate([
           'code' => 'required',
           'libelle' => 'required',
           'direction' => 'required'
         ]);

         $fonction = new Fonction();
         $fonction->code_fonction = $this->code;
         $fonction->lib_fonction = $this->libelle;
         $fonction->direction_id = $this->direction;

         $fonction->save();

         $this->code = "";
         $this->libelle ="";
         $this->direction ="";

         $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Fonction ajouté avec succès!"]);
    }

    public function goToEditFonction($fonctionId){

        $fonction = Fonction::find($fonctionId);
        $this->fonction_id = $fonction->id;
        $this->code = $fonction->code_fonction;
        $this->libelle = $fonction->lib_fonction;
       // $this->direction = $fonction->direction->direction_id;
    }


    public function editFonction(){

        $this->validate([
            'code' => 'required',
            'libelle' => 'required',
            'direction' => 'required'
        ]);
        
        $fonction = Fonction::find($this->fonction_id);
        $fonction->code_fonction = $this->code;
        $fonction->lib_fonction = $this->libelle;
        $fonction->direction_id = $this->direction;

        $fonction->save();

        $this->code = "";
        $this->libelle ="";
        $this->direction ="";

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Fonction mis à jour avec succès!"]);

    }

    public function confirmDelete($name, $id){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" => [
            "text" =>"Vous êtes sur le point de supprimer $name de la liste des fonctions. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            "data" =>[
                "fonction_id" => $id
            ]
        ]]);
    }

    public function deleteUser($id){
        Fonction::destroy($id);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Fonction supprimé avec succès!"]);
    }
}














