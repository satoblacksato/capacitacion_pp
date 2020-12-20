<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ImgWithSrcDefault extends Component
{
    public $name, $img, $w, $h,$class;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param string|null $img
     * @param int $w
     * @param int $h
     * @param string $class
     */
    public function __construct(string $name='',
                                string $img=null,
                                int $w=600,
                                int $h=400,
                                string $class='')
    {
        $this->name=$name;
        $this->img=$img;
        $this->w=$w;
        $this->h=$h;
        $this->class=$class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.img-with-src-default');
    }
}
