<?php

namespace App\Http\Livewire;

use App\Models\Chrono;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use App\Models\ChronoCourrierDepart;

class ChronoCourrierDepartComponent extends Component
{
    
    use WithPagination;
    public $search = "";
    public $isAddChrono = false;
    public $newChronoName = "";
    public $newValue = "";
    protected $paginationTheme = "bootstrap";
    public function render()
    {
        Carbon::setLocale("fr");
        $searchCriteria = "%".$this->search."%";
        $data = [
            "chronos" => ChronoCourrierDepart::where("nom", "like", $searchCriteria)->latest()->paginate(5)
        ];
        return view('livewire.chronoCourrierDepart.index', $data)->extends("layouts.base")->section("contenu");
    }

    public function toggleShowAddChronoForm(){
        if($this->isAddChrono){
            $this->isAddChrono = false;
            $this->newChronoName = "";
            $this->resetErrorBag(["newChronoName"]);
        }else{
            $this->isAddChrono = true;
        }
        
    }

    public function addNewChrono(){
        $validated = $this->validate([
             "newChronoName" => "required|max:50|unique:chrono_courrier_departs,nom"
        ]);

        ChronoCourrierDepart::create(["nom" => $validated["newChronoName"]]);

        $this->toggleShowAddChronoForm();

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Chrono ajouté avec succès!"]);
    }

    public function editChrono($id){
        $chrono = ChronoCourrierDepart::find($id);

        $this->dispatchBrowserEvent("showEditForm", ["chrono" => $chrono]);
    }

    public function updateChrono($id, $valueRromJS){
        $this->newValue = $valueRromJS;
        $validated = $this->validate([
            "newValue" => ["required", "max:50", Rule::unique("chrono_courrier_departs", "nom")->ignore($id)],
       ]);

       ChronoCourrierDepart::find($id)->update(["nom"=>$validated["newValue"]]);

       $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Chrono mis à jour avec succès!"]);
    }

    public function confirmDelete($name, $id){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" => [
            "text" =>"Vous êtes sur le point de supprimer $name de la liste des chronos. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            "data" =>[
                "chrono_id" => $id
            ]
        ]]);
    }

    public function deleteChrono($id){
         ChronoCourrierDepart::destroy($id);

         $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Chrono supprimé avec succès!"]);
    }
}











