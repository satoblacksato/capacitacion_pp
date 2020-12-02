<?php

namespace App\View\Components;

use Illuminate\View\Component;
use QData;
class MasterLayout extends Component
{
    public $categories;
    public $usersWithBook;
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
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $this->load();
        return view('layouts.master');
    }

    private function load(){
        $this->categories=QData::getCategoriesForRef();
        $this->usersWithBook=QData::getUsersWithBook();
    }
}
