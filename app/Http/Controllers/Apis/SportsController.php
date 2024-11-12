<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Resources\SportResource;
use App\Models\Packages;
use App\Models\SportPackage;
use App\Models\Sports;
use App\Models\User;
use App\Models\VendorSports;
use Illuminate\Http\Request;
use Validator;

class SportsController extends ResponseController
{
    public function getSportsList()
    {
        $sports = Sports::all();
        return $this->sendResponse(SportResource::collection($sports), 'Sports retrieved successfully.');
    }

    public function addSport(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'sport_id' => 'required|numeric',
            'package_ids' => 'required', 
        ]);
        
        if ($validatedData->fails()) {
            return $this->sendError('Validation Error.', $validatedData->errors(), 200);
        }
        $userId = (new User)->getUserId(); // Get the user ID
        // Parse and validate package IDs
        $packageIds = array_map('trim', explode(',', $request->input('package_ids')));
        $validPackageIds = Packages::whereIn('id', $packageIds)->pluck('id')->toArray();

        // Fetch all existing package_ids for the given sport_id and user_id in one query
        $existingPackageIds = SportPackage::where('sport_id', $request->input('sport_id'))
            ->where('user_id', $userId)
            ->pluck('package_id')
            ->toArray();

        // Filter out already existing package_ids from the list of valid package_ids
        $newPackageIds = array_diff($validPackageIds, $existingPackageIds);

        // Only proceed if there are new package_ids to insert
        if (!empty($newPackageIds)) {
            // Prepare the data for batch insertion
            $sportPackagesData = array_map(function ($packageId) use ($request, $userId) {
                return [
                    'sport_id' => $request->input('sport_id'),
                    'package_id' => $packageId,
                    'user_id' => $userId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }, $newPackageIds);
            // Insert the non-duplicate sport packages in a single query
            SportPackage::insert($sportPackagesData);
        }

        // Add to VendorSports if it does not exist
        $sportId = $request->input('sport_id');
        $vendorSportExists = VendorSports::where('sport_id', $sportId)->where('user_id', $userId)->exists();
        if (!$vendorSportExists) {
           VendorSports::create([
                'sport_id' => $sportId,
                'user_id' => $userId,
            ]);
        }
        return $this->sendResponse(null, 'Sport added successfully.');
    }
}
