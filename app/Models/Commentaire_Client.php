<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commentaire_Client extends Model
{
    protected $table = 'commentaire_client'; // Assurez-vous que le nom de la table correspond à celui de votre base de données
    public $timestamps = false;

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }
    
    public function partenaire()
    {
        return $this->belongsTo(Partenaire::class, 'id_partenaire');
    }
}
