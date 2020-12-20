<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\{Category, Book, User, UserBookSubscribe};
use App\Notifications\ContactUs;
use PDF;
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

    public function sendEmail(Request $request){
        $this->validate($request,[
           'name'=>'required',
           'email'=>'required|email',
           'description'=>'required|max:200',
        ]);
        optional(User::find(13))->notify(new ContactUs($request->only('name','email','description')));
        return redirect()->to('/');

    }

    public function subscribe(Book $book, Request $request){
        if(!$request->hasValidSignature()){
            abort(403);
        }

        if(UserBookSubscribe::where('user_id','=',auth()->user()->id)
      ->where(  'book_id','=',$book->id)->count()==0
        ){
            $subscribe=new UserBookSubscribe();
            $subscribe->user_id=auth()->user()->id;
            $subscribe->book_id=$book->id;
            $subscribe->save();
        }

        return redirect()->to('/');

    }

    public function pdf($num,Request  $request){
       // $users= \App\Models\User::where('id','=',$num)->get();
        $users= \App\Models\User::get();

       // $users = DB::select('call spp ? , ?',[$request->get('nombre'),'r']);

        $pdf=PDF::loadView('pdf',['title'=>'PDF BUILD','users'=>$users]);
        return $pdf->inline();
        // return $pdf->download('valor.pdf');
    }


    public function users(Request $request){
            if($request->ajax() && $request->method()=='POST'){
                return datatables()
                        ->of(User::query())
                        ->addColumn('profile_photo','users_col')
                        ->editColumn('created_at', function(User $user) {
                            return $user->created_at->diffForHumans();
                        })
                        ->rawColumns(['profile_photo'])
                        ->make(true);
            }
            return view('users',['users'=>User::query()->get()]);
    }
}
