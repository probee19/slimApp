<?php
namespace App\Models;

use Watson\Rememberable\Rememberable;
use Illuminate\Database\Eloquent\Model as Eloquent;

abstract class RememberModel extends Eloquent
{
    use Rememberable;
}
