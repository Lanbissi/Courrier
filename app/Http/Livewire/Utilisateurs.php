<?php

namespace App\Http\Livewire;

use App\Models\Fonction;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Utilisateurs extends Component
{
    use WithPagination;

    // Pour maintenir le style css de bootstrap
    protected $paginationTheme = "bootstrap";

    //Pour la gestion des pages courantes
    public $currentPage = PAGELIST;
    public $editmatricule;
    public $editnom;
    public $editprenom;
    public $editsexe;
    public $editemail;
    public $editusername;
    public $edittelephone1;
    public $edittelephone2;
    public $editfonction;
    public $editestdirecteur;

    public $matricule, $nom, $prenom, $sexe, $email, $username, $telephone1, $telephone2, $fonction, $estdirecteur, $password;

    public $user_id;

    //Tableau pour enregistrer les données formulaires
    public $editUser = [];
    public $rolepermission = [];
    

    public function render()
    {  
        Carbon::setLocale("fr");//Pour changer la langue en français
        $fonctions = Fonction::all();
        return view('livewire.utilisateurs.index', ["users" => User::latest()->paginate(5), "fonctions" =>$fonctions])->extends("layouts.base")->section("contenu");
    }

    //Méthode rules pour validation des champs
    /*public function rules(){
        if($this->currentPage == PAGEEDITFORM){

          return [
            'editUser.matricule' => ['required', 'matricule', Rule::unique("users", "matricule")->ignore($this->editUser['id'])],
            'editUser.nom' => 'required',
            'editUser.prenom' => 'required',
            'editUser.sexe' => 'required',
            'editUser.email' => ['required', 'email', Rule::unique("users", "email")->ignore($this->editUser['id'])],
            'editUser.username' => ['required', 'username', Rule::unique("users", "username")->ignore($this->editUser['id'])],
            'editUser.telephone1' => ['required', 'telephone1', Rule::unique("users", "telephone1")->ignore($this->editUser['id'])],
            'editUser.telephone2' => ['required', 'telephone2', Rule::unique("users", "telephone2")->ignore($this->editUser['id'])],
            'editUser.fonction' => 'required',
            'editUser.estdirecteur' => 'required',
          ];
        }   
            return [
                'newUser.matricule' => 'required|numeric|unique:users,matricule',
                'newUser.nom' => 'required',
                'newUser.prenom' => 'required',
                'newUser.sexe' => 'required',
                'newUser.email' => 'required|email|unique:users,email',
                'newUser.username' => 'required|unique:users,username',
                'newUser.telephone1' => 'required|numeric|unique:users,telephone1',
                'newUser.telephone2' => 'numeric|unique:users,telephone2',
                'newUser.fonction' => 'required',
                'newUser.estdirecteur' => 'required',
            ];
        
    }*/

    // Méthode pour accéder à chaque page
    public function goToaddUser(){
        $this->currentPage = PAGECREATEFORM;
    }

    public function goToEditUser($id){
        //Instruction permettant d'affecter les informations à chaque champ ou d'aller modifier
        $editUser = User::find($id);
        //dump($editUser);
        $this->user_id = $editUser->id;
        $this->editmatricule = $editUser->matricule;
        $this->editnom = $editUser->nom;
        $this->editprenom = $editUser->prenom;
        $this->editsexe = $editUser->sexe;
        //dump($this->editsexe);
        $this->edittelephone1 = $editUser->telephone1;
        $this->edittelephone2 = $editUser->telephone2;
        $this->editemail = $editUser->email;
        $this->editusername = $editUser->username;
        $this->editestdirecteur = $editUser->is_directeur;
        $this->editfonction = $editUser->fonction_id;
        
        $this->currentPage = PAGEEDITFORM;

        $this->populateRolePermission();
    }

    //Fonction de récupération des roles et permission
    public function populateRolePermission(){
        $this->rolepermission["roles"] = [];
        $this->rolepermission["permissions"] = [];

        $mapForCB = function($value){
            return $value["id"];
        };

        $roleIds = array_map($mapForCB, User::find($this->user_id)->roles->toArray());
        $permissionIds = array_map($mapForCB, User::find($this->user_id)->permissions->toArray());

        foreach(Role::all() as $role){
            if(in_array($role->id, $roleIds)){
                 array_push($this->rolepermission["roles"], ["role_id"=>$role->id, "role_nom"=>$role->nom, "active"=>true]);
            }else{
                array_push($this->rolepermission["roles"], ["role_id"=>$role->id, "role_nom"=>$role->nom, "active"=>false]);
            }
        }

        foreach(Permission::all() as $permission){
            if(in_array($permission->id, $permissionIds)){
                 array_push($this->rolepermission["permissions"], ["permission_id"=>$permission->id, "permission_nom"=>$permission->nom, "active"=>true]);
            }else{
                array_push($this->rolepermission["permissions"], ["permission_id"=>$permission->id, "permission_nom"=>$permission->nom, "active"=>false]);
            }
        }
        //La logique pour recharger les roles et permissions

    }

    public function goToListUser(){
        $this->currentPage = PAGELIST;
        $this->editUser = [];
    }

    // Fin Méthode pour accéder à chaque page
     
    public function viderChamps(){
        $this->reset(['matricule','nom','prenom','sexe','email','username','telephone1','telephone2','fonction','estdirecteur']);
    } 

    public function updated($fields){
           $this->validateOnly($fields,[
            'matricule' => 'required|numeric|unique:users,matricule',
            'nom' => 'required',
            'prenom' => 'required',
            'sexe' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'telephone1' => 'required|numeric|unique:users,telephone1',
            'telephone2' => 'numeric|unique:users,telephone2',
            'fonction' => 'required',
            'estdirecteur' => 'required',
           ]);
    }

    // Processus Ajout
    public function addUser(){

        $this->validate([
            'matricule' => 'required|numeric|unique:users,matricule',
            'nom' => 'required',
            'prenom' => 'required',
            'sexe' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'telephone1' => 'required|numeric|unique:users,telephone1',
            'telephone2' => 'numeric|unique:users,telephone2',
            'fonction' => 'required',
            'estdirecteur' => 'required',
        ]);

        $user = new User();
        $user->matricule = $this->matricule;
        $user->nom = $this->nom;
        $user->prenom = $this->prenom;
        $user->sexe = $this->sexe;
        $user->telephone1 = $this->telephone1;
        $user->telephone2 = $this->telephone2;
        $user->email = $this->email;
        $user->username = $this->username;
        $user->password = Hash::make("password");
        $user->fonction_id = $this->fonction;
        $user->is_directeur = $this->estdirecteur;
        $user->save();
        $this->viderChamps();   

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Utilisateur créé avec succès!"]);
        
    }

    // Fin processus ajout

    // Début Suppression

    // 1- Demande de confirmation
    public function confirmDelete($name, $id){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" => [
            "text" =>"Vous êtes sur le point de supprimer $name de la liste des utilisateurs. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            "data" =>[
                "user_id" => $id
            ]
        ]]);
    }

    // 2- Suppression proprement dite

    public function deleteUser($id){
         User::destroy($id);

         $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Utilisateur supprimé avec succès!"]);
    }

    // Fin de Suppression

    // Début édition

    public function updateUser(){

        $this->validate([
                'editmatricule' => ['required', 'numeric', Rule::unique("users", "matricule")->ignore($this->user_id)],
                'editnom' => 'required',
                'editprenom' => 'required',
                'editsexe' => 'required',
                'editemail' => ['required', 'email', Rule::unique("users", "email")->ignore($this->user_id)],
                'editusername' => ['required', Rule::unique("users", "username")->ignore($this->user_id)],
                'edittelephone1' => ['required', 'numeric', Rule::unique("users", "telephone1")->ignore($this->user_id)],
                //'edittelephone2' => ['numeric', Rule::unique("users", "telephone2")->ignore($this->user_id)],
                'editfonction' => 'required',
                'editestdirecteur' => 'required',
        ]);
        
          $user = User::find($this->user_id);

          $user->matricule  = $this->editmatricule;
          $user->nom = $this->editnom;
          $user->prenom = $this->editprenom;
          $user->sexe = $this->editsexe;
          $user->telephone1 = $this->edittelephone1;
          $user->telephone2 = $this->edittelephone2;
          $user->email = $this->editemail;
          $user->username = $this->editusername;
          $user->is_directeur = $this->editestdirecteur;
          $user->fonction_id = $this->editfonction;
          $user->save();

          $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Utilisateur mis à jour avec succès!"]);
    }

    // Réinitialisation de mot de passe

    public function confirmPwdReset(){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" => [
            "text" =>"Vous êtes sur le point de réinitialiser le mot de passe de cet utilisateur. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning"
        ]]);
    }

    public function resetPassword(){
        User::find($this->editUser["id"])->update(["password" => Hash::make(DEFAULTPASSWORD)]);
        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Mot de passe utilisateur réinitialisé avec succès!"]);
    }

    //Fonction permettant de mettre à jour les roles et les permissions dans la base de donnée

    public function updateRuleAndPermissions(){
        DB::table("user_role")->where("user_id", $this->user_id)->delete();
        DB::table("user_permission")->where("user_id", $this->user_id)->delete();

        foreach($this->rolepermission["roles"] as $role){
            if($role["active"]){
                User::find($this->user_id)->roles()->attach($role["role_id"]);
            }
        }

        foreach($this->rolepermission["permissions"] as $permission){
            if($permission["active"]){
                User::find($this->user_id)->permissions()->attach($permission["permission_id"]);
            }
        }

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Roles et permissions mis à jour avec succès!"]);
    }
}










