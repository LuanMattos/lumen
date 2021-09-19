<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    public $timestamps = false;
    protected $fillable = ['nome'];
    protected $perPage = 10;
    protected $appends = ['links'];

    public function episodios()
    {
        return $this->hasMany(Episodio::class);
    }

    // public function setNomeAttribute( $nome ){
    //     $this->attributes['nome'] = strtolower( $nome );
    // }

    public function getLinksAttribute( $links ): array
    { 
        return [
            'self'=>'/api/series/' . $this->id,
            'episodios'=>'/series/' . $this->id . '/episodios'
        ];

    }
    
}
