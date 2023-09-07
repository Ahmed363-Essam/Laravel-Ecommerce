<?php

namespace App\View\Components;

use Illuminate\View\Component;

use App\Models\Products;

class Product extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $Products = Products::active()->latest()->limit(8)->get();

        return view('components.product',compact('Products'));
    }
}
