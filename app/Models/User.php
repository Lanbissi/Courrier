<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'sexe',
        'telephone1',
        'telephone2',
        'email',
        'username',
        'password',
        'is_directeur',
        'photo',
        'fonction_id',      
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function service(){
        return $this->belongsTo(Fonction::class, "fonction_id", "id");
    }

    public function annotationarrivee(){
        return $this->hasMany(AnnotationArrivee::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class, "user_role", "user_id", "role_id");
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class, "user_permission", "user_id", "permission_id");
    }

    public function fonctions(){
        return $this->belongsToMany(Fonction::class, "user_fonction_courrier", "user_id", "fonction_id");
    }

    //fonction permettant de savoir si l'utilisateur à un role
    public function hasRole($role){
        return $this->roles()->where("nom", $role)->first() !== null;
    }

    public function hasFonction($fonction){
        return $this->fonctions()->where("code_fonction", $fonction)->first() !== null;
    }

    //fonction permettant de savoir si l'utilisateur à plusieurs role
    public function hasAnyRole($roles){
        return $this->roles()->whereIn("nom", $roles)->first() !== null;
    }

    public function hasAnyFonction($fonctions){
        return $this->fonctions()->whereIn("code_fonction", $fonctions)->first() !== null;
    }
}











