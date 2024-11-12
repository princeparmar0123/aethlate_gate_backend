<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class VendorController extends ResponseController
{
    public function getVendorApprovalStatus(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'mobile' => 'required|numeric|digits_between:10,15',
        ]);

        if ($validatedData->fails()) {
            return $this->sendError('Validation Error.', $validatedData->errors(), 200);
        }

        $data = User::where([['mobile', '=', $request->mobile], ['type', '<>', 'admin']])->first();
        if ($data) {
            $status = ($data->is_approved == '1') ? "approved" : (($data->is_approved == '0') ? "rejected" : "pending");
            return $this->sendResponse($status, 'Vendor status retrieved successfully.');
        } else {
            return $this->sendError('No record found.', null, 200);
        }
    }



    
}
