<?php

namespace App\Http\Livewire;

use App\Models\typeAnnotation;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class TypeAnnotationComponent extends Component
{
    use WithPagination;
    public $search = "";
    public $isAddTypeAnnotation = false;
    public $newTypeAnnotationName = "";
    public $newValue = "";
    protected $paginationTheme = "bootstrap";
    public function render()
    {
        Carbon::setLocale("fr");
        $searchCriteria = "%".$this->search."%";
        $data = [
            "typeannotations" => typeAnnotation::where("libAnnotation", "like", $searchCriteria)->latest()->paginate(5)
        ];
        return view('livewire.type_annotation.index', $data)->extends("layouts.base")->section("contenu");
    }

    public function toggleShowAddTypeAnnotationForm(){
        if($this->isAddTypeAnnotation){
            $this->isAddTypeAnnotation = false;
            $this->newTypeAnnotationName = "";
            $this->resetErrorBag(["newTypeAnnotationName"]);
        }else{
            $this->isAddTypeAnnotation = true;
        }
        
    }

    public function addTypeAnnotationNature(){
        $validated = $this->validate([
             "newTypeAnnotationName" => "required|max:50|unique:type_annotations,libAnnotation"
        ]);

        typeAnnotation::create(["libAnnotation" => $validated["newTypeAnnotationName"]]);

        $this->toggleShowAddTypeAnnotationForm();

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Type annotation ajouté avec succès!"]);
    }

    public function editTypeAnnotation($id){
        $typeannotation = typeAnnotation::find($id);

        $this->dispatchBrowserEvent("showEditForm", ["typeannotation" => $typeannotation]);
    }

    public function updateTypeAnnotation($id, $valueRromJS){
        $this->newValue = $valueRromJS;
        $validated = $this->validate([
            "newValue" => ["required", "max:50", Rule::unique("type_annotations", "libAnnotation")->ignore($id)],
       ]);

       typeAnnotation::find($id)->update(["libAnnotation"=>$validated["newValue"]]);

       $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Type annotation mis à jour avec succès!"]);
    }

    public function confirmDelete($libAnnotation, $id){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" => [
            "text" =>"Vous êtes sur le point de supprimer $libAnnotation de la liste des natures courriers arrivés. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            "data" =>[
                "type_Annotation_id" => $id
            ]
        ]]);
    }

    public function deleteTypeAnnotation($id){
        typeAnnotation::destroy($id);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Type annotation supprimé avec succès!"]);
   }
}
















