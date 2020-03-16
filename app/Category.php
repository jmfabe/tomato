<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
  use NodeTrait;

  public function products()
  {
    return $this->hasmany('App\Product');
  }
}
