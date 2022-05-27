<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Flight;
use App\Models\Country;

class Cart extends Model
{
    public $items;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart) {
        if($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($flight, $tickets, $trip_price, $id) {
        $storedItem = ['qty' => 0, 'price' => 0, 'flight' => $flight];
        if($this->items) {
            if(array_key_exists($id, $this->items)) {
                $storedItem = $this -> items[$id];
            }
        }
        $storedItem['qty'] += $tickets;
        $storedItem['price'] += $trip_price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty += $tickets;
        $this->totalPrice += $storedItem['price'];
    }
}
