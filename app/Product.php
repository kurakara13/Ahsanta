<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Promotion;

class Product extends Model
{
  protected $table = 'product';

  public function percentPrice(){
    return 'Rp. '.number_format($this->price);
  }

  public function promoPrice(){
    $promotion = Promotion::find($this->id_promotion);
    if($promotion->type == "percent"){
      $price = $this->price - (($promotion->ammount/100)*$this->price);
    }
    
    return 'Rp. '.number_format($price);
  }
}
