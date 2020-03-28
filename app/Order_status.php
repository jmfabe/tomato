<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_status extends Model
{
  public function status()
  {
    return $this->hasone('App\Order');
  }


  public function name()
  {
    return $this->hasone('App\Order_status_name','id','order_status');
  }
}
