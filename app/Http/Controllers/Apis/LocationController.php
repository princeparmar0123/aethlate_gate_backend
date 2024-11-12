<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;
use App\Models\Complex;
use App\Models\Location;
use App\Models\LocationComplex;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class LocationController extends ResponseController
{
    public function getLocationList(){
        $userId=Auth::user()->id;
        $data=Location::where('user_id',$userId)->get();
        return $this->sendResponse(LocationResource::collection($data), 'Location retrieved successfully.');
    }

    public function addLocation(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'address' => 'required|string|max:500',
            'gst_certificate' => 'required|file|mimes:jpg,jpeg,png,pdf|max:3072', // Assuming file upload, limit to 3MB
            'owner_name' => 'required|string|max:255',
        ]);

        if ($validatedData->fails()) {
            return $this->sendError('Validation Error.', $validatedData->errors(), 200);
        }
        $userId = (new User())->getUserId();

        //location
        $file = $request->file('gst_certificate');
        $original_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $file_name = $original_name . '-' . uniqid() . '.' . $extension;
        $path = $file->move(public_path('images/gst'), $file_name);

        $location = Location::create([
            'owner_name' => $request->input('owner_name'),
            'user_id' => $userId,
            'address' => $request->input('address'),
            'gst_certificate' => $file_name,
        ]);


        // Check if 'complex_ids' is provided
        if ($request->input('complex_ids')) {
            $complexIds = explode(',', $request->input('complex_ids'));
            $validComplexIds = Complex::whereIn('id', $complexIds)->pluck('id')->toArray();
            foreach ($validComplexIds as $complexId) {
                LocationComplex::create([
                    'location_id' => $location->id,
                    'complex_id' => $complexId,
                    'user_id' => $userId,
                ]);
            }
        }

        return $this->sendResponse($location, 'Location created successfully.');
    }
}
