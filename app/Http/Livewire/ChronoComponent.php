<?php

namespace App\Http\Livewire;

use App\Models\Chrono;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class ChronoComponent extends Component
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
            "chronos" => Chrono::where("lib_chrono", "like", $searchCriteria)->latest()->paginate(5)
        ];
        return view('livewire.chronos.index', $data)->extends("layouts.base")->section("contenu");
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
             "newChronoName" => "required|max:50|unique:chronos,lib_chrono"
        ]);

        Chrono::create(["lib_chrono" => $validated["newChronoName"]]);

        $this->toggleShowAddChronoForm();

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Chrono ajouté avec succès!"]);
    }

    public function editChrono($id){
        $chrono = Chrono::find($id);

        $this->dispatchBrowserEvent("showEditForm", ["chrono" => $chrono]);
    }

    public function updateChrono($id, $valueRromJS){
        $this->newValue = $valueRromJS;
        $validated = $this->validate([
            "newValue" => ["required", "max:50", Rule::unique("chronos", "lib_chrono")->ignore($id)],
       ]);

       Chrono::find($id)->update(["lib_chrono"=>$validated["newValue"]]);

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
         Chrono::destroy($id);

         $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Chrono supprimé avec succès!"]);
    }
}











