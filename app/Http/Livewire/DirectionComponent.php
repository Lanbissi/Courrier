<?php

namespace App\Http\Livewire;

use App\Models\Direction;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class DirectionComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    
    public $direction_id;
    public $code;
    public $libelle;
    public function render()
    {
        Carbon::setLocale("fr");
        return view('livewire.direction.index', ["directions" =>Direction::latest()->paginate(5)])->extends("layouts.base")->section("contenu");
    }

    public function updated($fields){
        $this->validateOnly($fields, [
           'code' => 'required',
           'libelle' => 'required'
        ]);
    }

    public function addDirection(){
         $this->validate([
           'code' => 'required',
           'libelle' => 'required'
         ]);

         $direction = new Direction();
         $direction->code_direction = $this->code;
         $direction->lib_direction = $this->libelle;

         $direction->save();

         $this->code = "";
         $this->libelle ="";

         $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Direction ajouté avec succès!"]);
    }

    public function goToEditDirection($directionId){

        $direction = Direction::find($directionId);
        $this->direction_id = $direction->id;
        $this->code = $direction->code_direction;
        $this->libelle = $direction->lib_direction;
    }


    public function editDirection(){

        $this->validate([
            'code' => 'required',
            'libelle' => 'required'
        ]);

        $direction = Direction::find($this->direction_id);
        $direction->code_direction = $this->code;
        $direction->lib_direction = $this->libelle;

        $direction->save();

        $this->code = "";
        $this->libelle ="";

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Direction mis à jour avec succès!"]);

    }

    public function confirmDelete($name, $id){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" => [
            "text" =>"Vous êtes sur le point de supprimer $name de la liste des directions. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            "data" =>[
                "direction_id" => $id
            ]
        ]]);
    }

    public function deleteUser($id){
        Direction::destroy($id);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Direction supprimé avec succès!"]);
    }
}














