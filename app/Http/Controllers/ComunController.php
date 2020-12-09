<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\{Category, Book, User};

class ComunController extends Controller
{
    public function createBook(Category $category){
        return view('book',compact('category'))->with([
            'action'=>'C','book'=>new Book()
        ]);
    }

    public function editBook(Book $book){
        return view('book')->with([
            'action'=>'U','book'=>$book,'category'=>$book->category
        ]);
    }

    public function viewBook(Book $book){
        return view('info-book',compact('book'));
    }

    public function getBooksByCategory(Category $category){
        return view('blank',compact('category'))->with(['identificator'=>'C']);
    }
    public function getBooksByUser(User $user){
        return view('blank',compact('user'))->with(['identificator'=>'U']);
    }

    public function changeLang($lang){
        session()->put('lang',$lang);
        return redirect()->back();
    }
}
