<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $items;
    public $totalAmount=0;
    public $totalQty=0;
    public function __construct($oldCart)
    {if($oldCart){
        $this->items=$oldCart->items;
        $this->totalQty=$oldCart->totalQty;
        $this->totalAmount=$oldCart->totalAmount;

    }
    else{
        $this->items=null;
    }

    }
    public function add($item,$id){
        $storeItem=['item'=>$item,'qty'=>0,'amount'=>$item->price];
        if($this->items){
            if(array_key_exists($id,$this->items)){
                $storeItem=$this->items[$id];
            }
        }
        $storeItem['qty']++;
        $storeItem['amount']=$item->price*$storeItem['qty'];
        $this->items[$id]=$storeItem;
        $this->totalQty++;
        $this->totalAmount +=$item->price;
    }
    public function decrease($id){
        $this->items[$id]['qty']--;
        $this->items[$id]['amount'] -=$this->items[$id]['item']['price'];
        $this->totalAmount -=$this->items[$id]['item']['price'];
        $this->totalQty--;
        if($this->items[$id]['qty']<1){
            unset($this->items[$id]);
        }
    }
    public function increase($id){
        $this->items[$id]['qty']++;
        $this->items[$id]['amount'] +=$this->items[$id]['item']['price'];
        $this->totalAmount +=$this->items[$id]['item']['price'];

    }

}
