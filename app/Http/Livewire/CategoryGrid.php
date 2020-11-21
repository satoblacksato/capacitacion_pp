<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryGrid extends Component
{
    use WithPagination;

    private $categories;

    public function render()
    {
        return view('livewire.category-grid')->with([
            'categories'=>$this->categories
        ]);
    }

    public function mount(){
        $this->categories=Category::paginate(20);
    }

   /* public $categories;

    public function render()
    {
        return view('livewire.category-grid');
    }

    public function mount(){
        $this->categories=Category::paginate(20);
    }*/
}
