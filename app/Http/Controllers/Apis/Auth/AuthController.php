<?php

namespace App\Http\Controllers\Apis\Auth;

use App\Http\Controllers\Apis\ResponseController;
use App\Http\Controllers\Controller;
use App\Models\User;
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
    public function register(Request $request)
    {
        // Validate the incoming request
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'city' => 'required|string|max:255',
            'mobile' => 'required|numeric|min:1000000000|max:999999999999999|unique:users,mobile',
            'password' => 'required|string|min:6',
        ]);
        if ($validatedData->fails()) {
            return $this->sendError('Validation Error.', $validatedData->errors());
        }
        $success = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'city' => $request->input('city'),
            'mobile' => $request->input('mobile'),
            'password' => bcrypt($request->input('password')), // Encrypt the password
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
            return $this->sendError('Validation Error.', $validatedData->errors());
        }

        // Find the user with the provided mobile number
        $user = User::where('mobile', $request->mobile)->first();

        if (!$user) {
            return $this->sendError('Unauthorized.', ['error' => 'User not found']);
        }

        // Check if OTP is provided in the request
        if ($request->filled('otp')) {
            
            // Verify the OTP
            if ($user->otp !== $request->otp) {
                return $this->sendError('Invalid OTP.', ['error' => 'The OTP provided is incorrect.']);
            }

            // Check if OTP is expired (valid for 2 minutes)
            $otpGeneratedTime = Carbon::parse($user->otp_created_at);
            if (now()->diffInMinutes($otpGeneratedTime) > 2) {
                return $this->sendError('OTP Expired.', ['error' => 'The OTP has expired. Please request a new one.']);
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
                $otp =(int) $user->otp;
            }

            // Return a response indicating OTP generation success
            $success['otp'] = $otp;
            $success['message'] = 'OTP generated successfully.';

            return $this->sendResponse($success, 'OTP generated successfully.');
        }
    }



}
