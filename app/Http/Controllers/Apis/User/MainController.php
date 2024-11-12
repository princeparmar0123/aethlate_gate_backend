<?php

namespace App\Http\Controllers\Apis\User;

use App\Http\Controllers\Apis\ResponseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class MainController extends ResponseController
{
    public function getSportComplexes(Request $request)
    {
        return "work in progress";
        $validatedData = Validator::make($request->all(), [
            'sportId' => 'required|integer|exists:sports,id',
        ]);

        if ($validatedData->fails()) {
            return $this->sendError('Validation Error.', $validatedData->errors(), 200);
        }

        return $request->sportId;
    }
}
