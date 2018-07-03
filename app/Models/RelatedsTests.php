<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class RelatedsTest extends Eloquent
{

    protected $table = 'related_tests';

    protected $fillable = [
		'id_test',
		'related_ids'
    ];


}
