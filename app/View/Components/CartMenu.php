<?php

namespace App\View\Components;

use Illuminate\View\Component;

use App\Repository\cart\CartModelRepository;

use App\Facades\cartFacade;

class CartMenu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $items;
    public function __construct(CartModelRepository $cart)
    {
        //
        $this->items = $cart;

      
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cart-menu');
    }
}
