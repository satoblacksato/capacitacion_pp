<?php


namespace App\Cache;


use App\Models\Category;
use Cache;
class QueryCache
{
    public function getCategoriesForRef(){
        return Cache::remember('getCategoriesForRef', 3600, function () {
            return Category::select('name','id','photo')->get();
        });
    }
}
