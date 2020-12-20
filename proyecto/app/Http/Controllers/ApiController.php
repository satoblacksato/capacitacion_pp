<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\TransformData;

class ApiController extends Controller
{
    public function booksByCategory(Category $category){
          $filterData=request()->get('bookName')??'';
           return new TransformData(
               $category->books()
                   ->when($filterData!='',function($query) use($filterData){
                       return $query->where('name','like',"%".$filterData."%");
                   })
                   ->with('userCreated')->paginate()
           );
    }

    public function booksByUser(User $user){
        $filterData=request()->get('bookName')??'';
        return new TransformData(
            $user->booksCreated()
                ->when($filterData!='',function($query) use($filterData){
                    return $query->where('name','like',"%".$filterData."%");
                })
                ->with('userCreated')->paginate()
        );
    }
}
