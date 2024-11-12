<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Resources\ComplexResource;
use App\Models\Complex;
use App\Models\LocationComplex;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ComplexController extends ResponseController
{

    public function getComplexList(){
        $userId=Auth::user()->id;
        $data = Complex::where('user_id', $userId)->with('images')->get();
        return $this->sendResponse(ComplexResource::collection($data), 'Complex retrieved successfully.');
    }


    public function addComplex(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'complex_name' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'complex_images' => 'required|array|min:1',
            'complex_images.*' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'complex_latitude' => 'required|numeric|between:-90,90', // Valid latitude range
            'complex_longitude' => 'required|numeric|between:-180,180', // Valid longitude range
            'complex_description' => 'required',
            'sport_id' => 'required|integer|exists:sports,id',
            'location_id' => 'required|integer|exists:locations,id',
        ]);

        if ($validatedData->fails()) {
            return $this->sendError('Validation Error.', $validatedData->errors(), 200);
        }

        $userId = (new User())->getUserId();
        $complex = Complex::create([
            'complex_name' => $request->input('complex_name'),
            'user_id' => $userId,
            'sport_id' => $request->input('sport_id'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'description' => $request->input('complex_description'),
        ]);
        // Handle image uploads and store them
        foreach ($request->file('complex_images') as $image) {
            $original_name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $file_name = $original_name . '-' . uniqid() . '.' . $extension;
            $path = $image->move(public_path('images/complex'), $file_name);
            $complex->images()->create([
                'url' => $file_name,  // Store the relative URL
            ]);
        }

        $locationComplex = LocationComplex::create([
            'location_id' => $request->input('location_id'),
            'complex_id' => $complex->id,
            'user_id' => $userId,
        ]);

        return $this->sendResponse($complex, 'Complex created successfully.');
    }
}
