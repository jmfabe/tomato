<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  public function category()
  {
    return $this->belongsto('App\Category');
  }

  public function branch()
  {
    return $this->belongsto('App\Branch');
  }

  public function options()
  {
    return $this->hasmany('App\Option');
  }
}
