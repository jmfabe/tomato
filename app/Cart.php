<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
  public function items()
  {
    return $this->hasmany('App\Cart_item');
  }

  public function address()
  {
    return $this->belongsto('App\Address');
  }
}
