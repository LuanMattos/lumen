<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Episodio extends Model
{
    protected $fillable = ['temporada', 'numero', 'assistido','serie_id'];
    protected $appends = ['links'];
    //tem timestap
    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function getAssistidoAttribute( $assistido ): bool{
        return $assistido;
    }

    public function getLinksAttribute( $links ): array
    { 
        return [
            'self'=>'/api/episodios/' . $this->id,
            'serie'=>'/api/series/' . $this->serie_id
        ];

    }
    
}

