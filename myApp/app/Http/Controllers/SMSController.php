<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Count;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SMSController extends Controller
{
    public function otp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'api_key' => 'required|string',
            'otp_code' => 'required|numeric',
            'phone_number' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $apiKey = $request->input('api_key');
        $otpCode = $request->input('otp_code');
        $phoneNumber = $request->input("phone_number");

        $user = User::where('api_key', $apiKey)->first();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid API key'
            ], 401);
        }

        [$smsCost, $country] = $this->getSmsCostByCountry($phoneNumber);

        $totalSms = Order::where('user_id', $user->id)
            ->where('status', 'completed')
            ->sum('total_sms');

        $countRecord = Count::where('user_id', $user->id)->first();
        $usedSms = $countRecord ? $countRecord->count : 0;

        if (($usedSms + $smsCost) > $totalSms) {
            return response()->json([
                'status' => 'error',
                'message' => 'OTP limit reached. Try again later.'
            ], 403);
        }

        $smsSent = $this->sms_test($phoneNumber, $otpCode);

        if ($smsSent) {
            if ($countRecord) {
                $countRecord->increment('count', $smsCost);
            } else {
                Count::create([
                    'user_id' => $user->id,
                    'count' => $smsCost
                ]);
            }

            DB::table('logs')->insert([
                'user_id' => $user->id,
                'phone_number' => $phoneNumber,
                'message' => $otpCode,
                'type' => 'otp',
                'country' => $country,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'OTP sent successfully',
                'api_key' => $apiKey,
                'otp_code' => $otpCode,
                'phone_number' => $phoneNumber,
                'sms_cost' => $smsCost,
                'country' => $country
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send OTP. Please try again later.'
            ], 500);
        }
    }

    private function getSmsCostByCountry($phoneNumber)
    {
        $phoneNumber = preg_replace('/[^0-9+]/', '', $phoneNumber);

        $prefixCosts = [
            '+95' => [1, 'Myanmar'],
            '+66' => [4, 'Thailand'],
            '+60' => [10, 'Malaysia'],
            '+65' => [20, 'Singapore'],
            '+81' => [35, 'Japan']
        ];

        foreach ($prefixCosts as $prefix => [$cost, $country]) {
            if (strpos($phoneNumber, $prefix) === 0) {
                return [$cost, $country];
            }
        }

        return [1, 'Myanmar']; // Default to Myanmar
    }

    public function sms_test($recipient, $otpCode)
    {
        $api_key = env('SMSPOH_KEY');
        $api_secret = env('SMSPOH_SECRET');
        $sender_id = 'ZVZ';
        $message = "Your OTP code is: $otpCode";

        $api_url = 'https://v3.smspoh.com/api/rest/send';

        $payload = [
            'to' => $recipient,
            'message' => $message,
            'from' => $sender_id
        ];

        $api_credentials = base64_encode("$api_key:$api_secret");

        $headers = [
            "Authorization: Bearer $api_credentials",
            'Content-Type: application/json'
        ];

        $ch = curl_init($api_url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

        $response = curl_exec($ch);

        if ($response === false) {
            error_log('cURL Error: ' . curl_error($ch));
            curl_close($ch);
            return false;
        }

        curl_close($ch);

        $response_data = json_decode($response, true);

        if (isset($response_data['messages'])) {
            error_log('Message sent successfully!');
            return true;
        } else {
            error_log('Failed to send message. Error: ' . ($response_data['message'] ?? 'Unknown error'));
            return false;
        }
    }
}
