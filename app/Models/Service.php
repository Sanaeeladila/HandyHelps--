<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    // Définir les relations avec Client et Partenaire
    // Modèle Service
    // Dans app/Models/Service.php

    protected $table = 'services';
    public $timestamps = false;

    public function client()
    {
        return $this->belongsTo('App\Models\Client', 'client_id');
    }

    public function partenaire()
    {
        return $this->belongsTo('App\Models\Partenaire', 'partenaire_id');
    }

}
