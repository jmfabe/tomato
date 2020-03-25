<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart_item extends Model
{
  public function addons()
  {
    return $this->belongsToMany('App\Addon');
  }
  public function option()
  {
    return $this->belongsto('App\Option');
  }
  public function cart()
  {
    return $this->belongsto('App\Cart');
  }
}
