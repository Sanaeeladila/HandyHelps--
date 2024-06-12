<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    public $timestamps = false;

    // Définir la relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function commentaire_partenaire()
    {
        return $this->hasMany(Commentaire_Partenaire::class);
    }
}
