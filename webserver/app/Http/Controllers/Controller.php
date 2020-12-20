<?php

namespace App\Http\Controllers;

use App\Exceptions\CoreError;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Validator;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function validateAPI(Request $request, $rules)
    {
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            throw new CoreError(json_encode($validator->getMessageBag()->all()), 422);
        }
    }

}
