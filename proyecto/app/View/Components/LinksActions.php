<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LinksActions extends Component
{
    public $rEdit;
    public $rDelete;
    public $objKey;

    /**
     * Create a new component instance.
     *
     * @param $rEdit
     * @param $rDelete
     */
    public function __construct($rEdit,$rDelete,$objKey)
    {
        $this->rDelete=$rDelete;
        $this->rEdit=$rEdit;
        $this->objKey=$objKey;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.links-actions');
    }
}
