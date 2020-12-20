<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;

class DashboardCategories extends Component
{
    use WithFileUploads;

    public $input;
    public $data=[];
    public $users=[];

    public $photo;
    public function save()
    {
        $this->validate([
            'photo' => 'image|max:1024',
        ]);
        $this->photo->store('photos');
    }






    public function mount($random){
      $this->users=User::where('id','<=',$random)->get();
    }


    public function render()
    {
        $this->validador();
        return view('livewire.dashboard-categories');
    }

    private function validador(){
        $this->data=[];
        if(Str::length($this->input)>=4){
            $this->data=Category::where('name','like',"%".trim($this->input)."%")->get();
            $this->dispatchBrowserEvent('viewMessage',['msg'=>'Existen '.$this->data->count().' categorias']);
        }
    }

    public function getRandom(){
        $this->dispatchBrowserEvent('viewMessage',['msg'=>random_int(5,50)]);
    }

}
