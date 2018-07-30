<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class ShareCitation extends Eloquent
{
    protected $table = "shares_citations";

    protected $fillable = [
        'user_id',
        'citation_id',
        'btn_share',
        'partages_count',
        'shares_count',
        'cron_flag',
        'comments_count',
        'reactions_count',
        'lang',
        'ab_testing'
    ];

    public function citationInfo(){
        return $this->belongsTo('App\Models\Citation', 'citation_id', 'id_citation');
    }


}
