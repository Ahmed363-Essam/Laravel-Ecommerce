<?php

namespace App\Repository\cart;
use App\Models\Products;
use Illuminate\Support\Collection;

interface CartRepository
{
    public function get() : Collection ; // return all data in the cart by using cookie

    public function add(Products $Products,$quantity) ;  // store data in the cart by using cookie
 
    public function update(Products $Products , $quantity);  // update quantity in the cart

    public function delete($id);  // delete data in the cart model

    public function empty();  // delete all data in the cart

    public function total() : float;  // sumtion cart data

}