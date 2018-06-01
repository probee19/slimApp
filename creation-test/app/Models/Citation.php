<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Citation extends Eloquent
{

    protected $table = 'citations';

    protected $fillable = [
        'id_citation',
        'id_citation_owner',
        'id_rubrique',
        'titre_citation',
        'citation_description',
        'statut',
        'codes_countries',
        'seen_count',
        'code_php',
        'code_css',
        'code_js',
        'code_head',
        'code_bottom',
        'shares_count',
        'default_lang',
        'if_translated',
        'if_personalizable'
    ];


    public function citationInfo(){
        return $this->belongsTo('App\Models\CitationInfo', 'id_citation', 'id_citation');
    }
}
