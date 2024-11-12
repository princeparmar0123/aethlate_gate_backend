<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Resources\PackageResource;
use App\Models\Packages;
use App\Models\SportPackage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class PackageController extends ResponseController
{
    public function getPackageList(){
        $userId=Auth::user()->id;
        $packages=Packages::where('user_id',$userId)->get();
        return $this->sendResponse(PackageResource::collection($packages), 'Packages retrieved successfully.');
    }

    public function addPackage(Request $request){
        $validatedData = Validator::make($request->all(), [
            'sport_id' => 'integer|exists:sports,id',
            'package_name' => 'required|string|max:255',
            'package_price' => 'required|numeric|min:0', // Positive price
            'package_validity' => 'required|date|date_format:Y-m-d|after:today',
            'package_description' => 'required|string|max:1000', // Description with reasonable max length
        ]);
        
        if ($validatedData->fails()) {
            return $this->sendError('Validation Error.', $validatedData->errors(), 200);
        }
        $userId=(new User())->getUserId();
        $package = Packages::create([
            'package_name' => $request->input('package_name'),
            'user_id' => $userId,
            'price' => $request->input('package_price'),
            'validity' => $request->input('package_validity'),
            'description' => $request->input('package_description'),
        ]);
        
        if($request->input('sport_id')){
            SportPackage::create([
                'sport_id' => $request->input('sport_id'),
                'package_id' => $package->id,
                'user_id' => $userId,
            ]);
        }
        return $this->sendResponse($package, 'Package created successfully.');
    }
}
