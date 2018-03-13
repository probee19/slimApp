<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;
class Test extends Eloquent
{
    protected $table = 'tests';

    protected $fillable = [
        'title',
        'test_count',
        'created_at',
        'updated_at'
    ];
}