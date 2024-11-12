<?php

namespace App\Http\Controllers\Apis\Auth;

use App\Http\Controllers\Apis\ResponseController;
use App\Http\Controllers\Controller;
use App\Models\Complex;
use App\Models\Location;
use App\Models\LocationComplex;
use App\Models\Packages;
use App\Models\SportPackage;
use App\Models\User;
use App\Models\VendorSports;
use Carbon\Carbon;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends ResponseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function userRegister(Request $request)
    {
        // Validate the incoming request
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'city' => 'required|string|max:255',
            'mobile' => 'required|numeric|min:1000000000|max:999999999999999|unique:users,mobile',
            'password' => 'required|string|min:6',
            'latitude' => 'required|numeric|between:-90,90', // Valid latitude range
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        if ($validatedData->fails()) {
            return $this->sendError('Validation Error.', $validatedData->errors(),200);
        }
        $success = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'city' => $request->input('city'),
            'mobile' => $request->input('mobile'),
            'is_approved' => '1',
            'type' => 'user',
            'password' => bcrypt($request->input('password')),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);
        return $this->sendResponse($success, 'User registered successfully.');
    }

    public function login(Request $request)
    {
        // Validate the incoming request
        $validatedData = Validator::make($request->all(), [
            'mobile' => 'required|numeric',
        ]);

        if ($validatedData->fails()) {
            return $this->sendError('Validation Error.', $validatedData->errors(),200);
        }

        // Find the user with the provided mobile number
        $user = User::where('mobile', $request->mobile)->where('type', 'user')->first();

        if (!$user) {
            return $this->sendError('Unauthorized.', ['error' => 'User not found'],200);
        }

        // Check if OTP is provided in the request
        if ($request->filled('otp')) {

            // Verify the OTP
            if ($user->otp !== $request->otp) {
                return $this->sendError('Invalid OTP.', ['error' => 'The OTP provided is incorrect.'],200);
            }

            // Check if OTP is expired (valid for 2 minutes)
            $otpGeneratedTime = Carbon::parse($user->otp_created_at);
            if (now()->diffInMinutes($otpGeneratedTime) > 2) {
                return $this->sendError('OTP Expired.', ['error' => 'The OTP has expired. Please request a new one.'],200);
            }
            // OTP is valid, generate the access token
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['name'] = $user->name;

            // Clear the OTP after successful verification (optional)
            $user->otp = null;
            $user->otp_created_at = null;
            $user->save();

            return $this->sendResponse($success, 'User logged in successfully.');
        } else {
            // Only mobile is provided, check OTP validity or generate a new OTP if expired
            $otpGeneratedTime = Carbon::parse($user->otp_created_at);
            if (!$user->otp || now()->diffInMinutes($otpGeneratedTime) > 2) {
                // Generate a unique 6-digit OTP
                do {
                    $otp = random_int(100000, 999999);
                } while (User::where('otp', $otp)->exists());

                // Store the new OTP and its creation time
                $user->otp = $otp;
                $user->otp_created_at = now();
                $user->save();
            } else {
                // Use the existing OTP within the 2-minute validity window
                $otp = (int) $user->otp;
            }

            // Return a response indicating OTP generation success
            $success['otp'] = $otp;
            $success['message'] = 'OTP generated successfully.';

            return $this->sendResponse($success, 'OTP generated successfully.');
        }
    }

    public function vendorRegister(Request $request)
    {
        // Validate the incoming request
        $validatedData = Validator::make($request->all(), [
            // Basic User Info
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'city' => 'required|string|max:255',
            'mobile' => 'required|numeric|digits_between:10,15|unique:users,mobile',
            'password' => 'required|string|min:6|max:50', // Max length for better security
            // Location Information
            'address' => 'required|string|max:500',
            'gst_certificate' => 'required|file|mimes:jpg,jpeg,png,pdf|max:3072', // Assuming file upload, limit to 3MB
            'owner_name' => 'required|string|max:255',
            // Complex Details
            'complex_name' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i', // Expecting HH:MM format for time
            'end_time' => 'required|date_format:H:i|after:start_time', // Ensures end_time is after start_time
            'complex_images' => 'required|array|min:1', // Make complex_image required as an array with at least one item
            'complex_images.*' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'complex_latitude' => 'required|numeric|between:-90,90', // Valid latitude range
            'complex_longitude' => 'required|numeric|between:-180,180', // Valid longitude range
            'complex_description' => 'required', 
            // Sports Info
            'sport_id' => 'required|integer|exists:sports,id',
            // Package Details
            'package_name' => 'required|string|max:255',
            'package_price' => 'required|numeric|min:0', // Positive price
            'package_validity' => 'required|date|date_format:Y-m-d|after:today',
            'package_description' => 'required|string|max:1000', // Description with reasonable max length
        ]);

        if ($validatedData->fails()) {
            return $this->sendError('Validation Error.', $validatedData->errors(),200);
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'city' => $request->input('city'),
            'mobile' => $request->input('mobile'),
            'type' => 'vendor',
            'is_approved' => 'pending',
            'password' => bcrypt($request->input('password')), // Encrypt the password
        ]);

        if ($user) {
            //location
            $file = $request->file('gst_certificate');
            $original_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $file_name = $original_name . '-' . uniqid() . '.' . $extension;
            $path = $file->move(public_path('images/gst'), $file_name);
            $location = Location::create([
                'owner_name' => $request->input('owner_name'),
                'user_id' => $user->id,
                'address' => $request->input('address'),
                'gst_certificate' => $file_name,
            ]);
            //package
            $package = Packages::create([
                'package_name' => $request->input('package_name'),
                'user_id' => $user->id,
                'price' => $request->input('package_price'),
                'validity' => $request->input('package_validity'),
                'description' => $request->input('package_description'),
            ]);
            //enter sport id into sportpackage table
            $sportPackage = SportPackage::create([
                'sport_id' => $request->input('sport_id'),
                'package_id' => $package->id,
            ]);
            // Vendor Sports 
            $vendorSports = VendorSports::create([
                'sport_id' => $request->input('sport_id'),
                'user_id' => $user->id,
            ]);
            //complex
            $complex = Complex::create([
                'complex_name' => $request->input('complex_name'),
                'user_id' => $user->id,
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
                'location_id' => $location->id,
                'complex_id' => $complex->id,
            ]);
            return $this->sendResponse($user, 'User registered successfully.');
        } else {
            return $this->sendError('Unable to create user',null,200);
        }
    }







    public function vendorLogin(Request $request)
    {
        // Validate the incoming request
        $validatedData = Validator::make($request->all(), [
            'mobile' => 'required|numeric',
        ]);

        if ($validatedData->fails()) {
            return $this->sendError('Validation Error.', $validatedData->errors(),200);
        }

        // Find the user with the provided mobile number
        $user = User::where('mobile', $request->mobile)->where('type', 'vendor')->first();

        if (!$user) {
            return $this->sendError('Unauthorized.', ['error' => 'User not found'],200);
        }

        if ($user) {
            $status = ($user->is_approved == '1') ? "approved" : (($user->is_approved == '0') ? "rejected" : "pending");
            if($status != 'approved'){
                return $this->sendError('Unauthorized.', ['error' => 'Vendor approval is '.$status],200);
            }
        }

        // Check if OTP is provided in the request
        if ($request->filled('otp')) {

            // Verify the OTP
            if ($user->otp !== $request->otp) {
                return $this->sendError('Invalid OTP.', ['error' => 'The OTP provided is incorrect.'],200);
            }

            // Check if OTP is expired (valid for 2 minutes)
            $otpGeneratedTime = Carbon::parse($user->otp_created_at);
            if (now()->diffInMinutes($otpGeneratedTime) > 2) {
                return $this->sendError('OTP Expired.', ['error' => 'The OTP has expired. Please request a new one.'],200);
            }
            // OTP is valid, generate the access token
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['name'] = $user->name;

            // Clear the OTP after successful verification (optional)
            $user->otp = null;
            $user->otp_created_at = null;
            $user->save();

            return $this->sendResponse($success, 'Vendor logged in successfully.');
        } else {
            // Only mobile is provided, check OTP validity or generate a new OTP if expired
            $otpGeneratedTime = Carbon::parse($user->otp_created_at);
            if (!$user->otp || now()->diffInMinutes($otpGeneratedTime) > 2) {
                // Generate a unique 6-digit OTP
                do {
                    $otp = random_int(100000, 999999);
                } while (User::where('otp', $otp)->exists());

                // Store the new OTP and its creation time
                $user->otp = $otp;
                $user->otp_created_at = now();
                $user->save();
            } else {
                // Use the existing OTP within the 2-minute validity window
                $otp = (int) $user->otp;
            }

            // Return a response indicating OTP generation success
            $success['otp'] = $otp;
            $success['message'] = 'OTP generated successfully.';

            return $this->sendResponse($success, 'OTP generated successfully.');
        }
    }
}
