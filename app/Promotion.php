<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
  protected $table = 'promotion';

  public function percentPricePromo(){
    return 'Rp. '.number_format($this->minimum_price);
  }
}
