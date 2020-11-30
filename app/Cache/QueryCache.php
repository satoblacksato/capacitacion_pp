<?php


namespace App\Cache;


use App\Models\{Category,Book,User};
use Cache;
use DB;
class QueryCache
{
    public function getCategoriesForRef(){
        return Cache::remember('getCategoriesForRef', config('customVars.seconds_in_cache'), function () {
            return Category::select('name','id','photo','slug')->get();
        });
    }

    public function getLastBooks(){
        return Cache::remember('getLastBooks', config('customVars.seconds_in_cache'), function () {
            return Book::with(['category', 'userCreated'])->orderBy('created_at', 'DESC')->limit(config('customVars.limit_in_query'))->get();
        });
    }

    public function getUsersWithBook(){
        //DBUILDER SQL PLANO  ARRAY de OBJETOS
      /* $result= DB::select("select u.name,u.email,u.slug, count(u.id) as books
                            from users as u
                            inner join books as b
                            on b.created_user =u.id
                            group by u.name,u.email,u.slug
                            ");*/

        //DB BUILDER Collection objetos
       /* $result= DB::table('users as u')
            ->join('books as b','b.created_user','=','u.id')
            ->select('u.name','u.email','u.slug',DB::raw('count(u.id) as books'))
            ->groupBy(['u.name','u.email','u.slug'])->get();
        dd($result->where('books','>',1));*/


        //ELOQUENT CON BUILDER
       /*
        $result=User::join('books as b','b.created_user','=','users.id')
            ->select('users.name','users.email','users.slug',DB::raw('count(users.id) as books'))
            ->groupBy(['users.name','users.email','users.slug'])->get();*/

        return Cache::remember('getUsersWithBook', config('customVars.seconds_in_cache'), function () {
            return User::withCount('booksCreated')->has('booksCreated', '>', 0)->get();
        });

    }
}
