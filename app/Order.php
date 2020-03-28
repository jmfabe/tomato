<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  public function orderitems()
{
  return $this->hasmany('App\Order_item');
}

public function user()
{
  return $this->belongsto('App\User');
}
public function statuses()
{
  return $this->hasmany('App\Order_status');
}
}
