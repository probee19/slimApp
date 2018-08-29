<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class ShareStory extends Eloquent
{
    protected $table = "shares_stories";

    protected $fillable = [
        'user_id',
        'story_id',
        'btn_share',
        'partages_count',
        'shares_count',
        'cron_flag',
        'comments_count',
        'reactions_count',
        'lang',
        'ab_testing'
    ];

    public function storyInfo(){
        return $this->belongsTo('App\Models\Story', 'story_id', 'id_story');
    }


}
