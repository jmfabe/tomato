<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public function hours()
    {
      return $this->hasmany('App\Branch_hour');
    }

    
}
