<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommentairePartenaire extends Model
{
    use HasFactory;

    protected $table = 'commentaire_partenaire';
    protected $primaryKey = 'id_commentaire'; 

    protected $fillable = [
        'id_commentaire', 'id_client', 'id_partenaire', 'id_service', 'commentaire', 'date', 'rating'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client', 'id');
    }

    public function partenaire()
    {
        return $this->belongsTo(Partenaire::class, 'id_partenaire', 'id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'id_service', 'id');
    }
}
