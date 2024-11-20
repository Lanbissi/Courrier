<?php

namespace App\Http\Livewire;

use App\Models\CourrierArrive;
use App\Models\PieceJointeCourrierArrivee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class PJCourrierArriveComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = "bootstrap";
    
    public $numero;
    public $fichier;
    public function render()
    {
        return view('livewire.PJCourrierArrive.index', ["pj" => PieceJointeCourrierArrivee::latest()->paginate(5)])->extends("layouts.base")->section("contenu");
    }

    public function updated($fields){
        $this->validateOnly($fields, [
           'numero' => 'required|numeric',
           'fichier' => 'required|mimes:pdf'
        ]);
    }

    public function addFile(){
        $this->validate([
            'numero' => 'required|numeric',
            'fichier' => 'required|mimes:pdf'
        ]);

        //$courrier = CourrierArrive::where('numPrimaire', $this->numero)->get();
       // dump($courrier);

        $piecejointe = new PieceJointeCourrierArrivee();
        $piecejointe->courrier_arrive_id = $this->numero;
        
        $fichierName = Carbon::now()->timestamp . '.' . $this->fichier->extension();
        $this->fichier->storeAs('fichier',$fichierName);

        $piecejointe->pjNumerise = $fichierName;

        $piecejointe->save();

        $this->numero = "";
        $this->fichier = "";

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Pièce jointe ajoutée avec succès!"]);
    }

         
}









