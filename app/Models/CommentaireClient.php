<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommentaireClient extends Model
{
    use HasFactory;

    // Nom de la table si différent du nom du modèle au pluriel
    protected $table = 'commentaire_client';

    // Clés primaires et étrangères si elles ne suivent pas les conventions de nommage de Laravel
    protected $primaryKey = 'id_commentaire';

    // Propriétés que l'on peut assigner massivement
    protected $fillable = ['id_client', 'id_partenaire', 'id_service', 'commentaire', 'date', 'commentaire_partenaire', 'rating'];

    // Relations avec les autres modèles

    /**
     * Relation avec le modèle Client
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client', 'id');
    }

    /**
     * Relation avec le modèle Partenaire
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partenaire()
    {
        return $this->belongsTo(Partenaire::class, 'id_partenaire', 'id');
    }

    /**
     * Relation avec le modèle Service
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'id_service', 'id');
    }
}
