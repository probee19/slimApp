<?php
namespace App\Models;

class TestModel extends RememberModel
{
    //
    protected $table = 'tests';

    protected $fillable = [
        'id_test',
        'affichage_discover_count'
    ];
}
