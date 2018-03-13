<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class TestOwner extends Eloquent
{
    protected $table = "test_owner";
    protected $fillable = [
      'id_test_owner',
      'nom',
      'prenoms',
      'email'
    ];

}
