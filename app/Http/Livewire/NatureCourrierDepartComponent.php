<?php

namespace App\Http\Livewire;

use App\Models\NatureCourrierDepart;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class NatureCourrierDepartComponent extends Component
{
    use WithPagination;
    public $search = "";
    public $isAddNature = false;
    public $newNatureName = "";
    public $newValue = "";
    protected $paginationTheme = "bootstrap";
    public function render()
    {
        Carbon::setLocale("fr");
        $searchCriteria = "%".$this->search."%";
        $data = [
            "natures" => NatureCourrierDepart::where("nom", "like", $searchCriteria)->latest()->paginate(5)
        ];
        return view('livewire.natureCourrierDepart.index', $data)->extends("layouts.base")->section("contenu");
    }

    public function toggleShowAddNatureForm(){
        if($this->isAddNature){
            $this->isAddNature = false;
            $this->newNatureName = "";
            $this->resetErrorBag(["newNatureName"]);
        }else{
            $this->isAddNature = true;
        }
        
    }

    public function addNewNature(){
        $validated = $this->validate([
             "newNatureName" => "required|max:50|unique:nature_courrier_arrive,nom"
        ]);

        NatureCourrierDepart::create(["nom" => $validated["newNatureName"]]);

        $this->toggleShowAddNatureForm();

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Nature courrier arrivé ajouté avec succès!"]);
    }

    public function editNature($id){
        $nature = NatureCourrierDepart::find($id);

        $this->dispatchBrowserEvent("showEditForm", ["nature" => $nature]);
    }

    public function updateNature($id, $valueRromJS){
        $this->newValue = $valueRromJS;
        $validated = $this->validate([
            "newValue" => ["required", "max:50", Rule::unique("nature_courrier_departs", "nom")->ignore($id)],
       ]);

       NatureCourrierDepart::find($id)->update(["nom"=>$validated["newValue"]]);

       $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Nature courrier départ mis à jour avec succès!"]);
    }

    public function confirmDelete($name, $id){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" => [
            "text" =>"Vous êtes sur le point de supprimer $name de la liste des natures courriers arrivés. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            "data" =>[
                "nature_id" => $id
            ]
        ]]);
    }

    public function deleteNature($id){
         NatureCourrierDepart::destroy($id);

         $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Nature courrier arrivé supprimé avec succès!"]);
    }

}
