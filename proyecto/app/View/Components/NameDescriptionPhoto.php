<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NameDescriptionPhoto extends Component
{
    public $name;
    public $description;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param string $description
     */
    public function __construct($name='', $description='')
    {
       $this->name=$name;
       $this->description=$description;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.name-description-photo');
    }
}
