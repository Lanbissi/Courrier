<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileCourrierArrive extends Model
{
    use HasFactory;

    protected $table = "file_courrier_arrive";
    protected $fillable = ['fileName'];

    public function courrier_arrive(){
        return $this->hasMany(CourrierArrive::class);
     }
}
