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
      return 'Rp. '.number_format($price);
    }elseif($promotion->type == "free ongkir"){
      return '<i class="fa fa-archive"></i> Free Ongkir';
    }elseif($promotion->type == "get item"){
      $minOrder = $promotion->minimum_order;
      $ammount = $promotion->ammount;
      return 'Buy '.$minOrder.' Get '.$ammount.' Item';
    }elseif($promotion->type == "price"){
      $price = $this->price - $promotion->ammount;
      return 'Rp. '.number_format($price);
    }
  }
}
