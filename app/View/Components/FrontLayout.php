<?php

namespace App\View\Components;

use Illuminate\View\Component;

use App\Models\Categories;

class FrontLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $title = 'sasa';

    public $categories;

    public function __construct($title, Categories $categories)
    {
        //
        $this->title  = $title;

        $this->categories = $categories::with(['children'])->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        return view('layouts.front');
    }
}
