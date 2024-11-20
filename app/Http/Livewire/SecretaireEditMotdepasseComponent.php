<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class SecretaireEditMotdepasseComponent extends Component
{
    public $oldpassword;
    public $newpassword;
    public $currentPage = PAGEEDITFORM;
    public function render()
    {
        return view('livewire.password.index')->extends('layouts.base')->section('contenu');
    }

    public function updated($fields){
        $this->validateOnly($fields, [
            'oldpassword'=> ['required', 'string', 'min:8'],
            'newpassword'=> ['required', 'string', 'min:8'],
        ]);
    }

    public function updatePassword(){
        $this->validate([
            'oldpassword'=> 'required',
            'newpassword'=> 'required',
        ]);
        $request = User::where('id', Auth::user()->id)->first();
        if ($request && password_verify($this->oldpassword, $request->password)) {
            //$pw = password_hash($this->newpassword, PASSWORD_BCRYPT);
            User::find($request->id)->update(["password"=>Hash::make($this->newpassword)]);
            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Mot de passe utilisateur mis à jour avec succès!"]);

            $this->oldpassword = "";
            $this->newpassword = "";
        }else{
            $this->dispatchBrowserEvent("showInfoMessage", ["message" => "Vous n'avez pas entrer correctement votre ancien mot de passe!"]);
        }
    }
}
