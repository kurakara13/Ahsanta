<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $table = 'product';

  public function percentPrice(){
    return 'Rp. '.number_format($this->price);
  }
}
