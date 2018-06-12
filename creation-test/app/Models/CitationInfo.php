<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class CitationInfo extends Eloquent
{

    protected $table = 'citation_info';

    protected $fillable = [
        'id_citation',
        'titre_citation',
        'citation_description',
        'url_image_citation',
        'lang',
        'code_php'
    ];
    public function citationInfos(){
        return $this->belongsTo('App\Models\Citation', 'id_citation', 'id_citation');
    }
}
