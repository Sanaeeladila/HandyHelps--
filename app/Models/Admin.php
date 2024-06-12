<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    protected $table = 'admins'; // Spécifiez le nom de la table si ce n'est pas le pluriel du nom du modèle
    // protected $primaryKey = 'id'; // Spécifiez si la clé primaire n'est pas 'id'
    public $timestamps = false; // Désactivez les timestamps si vous n'en avez pas besoin
}