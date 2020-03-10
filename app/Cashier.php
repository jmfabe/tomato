<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cashier extends Authenticatable
{
  public function branch()
  {
    return $this->belongsto('App\Branch');
  }
}
