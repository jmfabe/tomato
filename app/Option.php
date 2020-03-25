<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
  public function product()
  {
    return $this->belongsto('App\Product');
  }
}
