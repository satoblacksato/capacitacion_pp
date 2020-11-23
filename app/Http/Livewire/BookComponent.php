<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{Category, Book, Photo};
use Livewire\WithFileUploads;
use DB;
use Exception;
use App\Jobs\SendTotalsAndNewBook;

class BookComponent extends Component
{
    use WithFileUploads;

    public $category;
    public $book;
    public $action;

    public $name;
    public $description;
    public $covers=[];
    public $photosInDatabase=[];

    public function render()
    {
        return view('livewire.book-component');
    }

    public function mount(Category $category, Book $book, string $action){
        $this->category=$category;
        $this->book=$book;
        $this->action=$action;
        $this->loadInfo($book->name,$book->description,$book->photos);
    }

    private function loadInfo($name='',$description='',$photos=[]){
        $this->name=$name;
        $this->description=$description;
        $this->photosInDatabase=$photos;
    }


    public function storeBook(){
        $this->validate(
          [
              'name'=>'required|max:30',
              'description'=>'required|max:100',
              'covers.*'=>'required|image|max:1024'
          ]
        );

        try{
            DB::beginTransaction();
                $this->book->fill(['name'=>$this->name,'description'=>$this->description]);
                $this->category->books()->save($this->book);
                $photos=[];
                foreach ($this->covers as $photo){
                    $photos[]=new Photo(['name'=>$photo]);
                }
                if(count($photos)>0){
                    $this->book->photos()->saveMany($photos);
                }
            DB::commit();
                if($this->action=='C'){
                    SendTotalsAndNewBook::dispatch($this->book);
                    $this->loadInfo();

                }


                $this->dispatchBrowserEvent('msgBook',['msg'=>__('admin.book_saved')]);
        }catch (Exception $ex){
            DB::rollBack();
            throw $ex;
        }

    }
}
