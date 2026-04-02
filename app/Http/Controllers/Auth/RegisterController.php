<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Barangay;
use App\Models\UserVerification;
use App\Models\UserVerificationFile;

class RegisterController extends Controller {

    // STEP 1 — Personal Info
    public function step1(Request $request) {
        $data = $request->validate([
            'given_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:50',
            'gender' => 'required|in:Male,Female,Other',
        ]);

        session(['registration.personal' => $data]);

        return redirect()->route('register.address');
    }

    // STEP 2 — Address Info + File Upload
    public function step2(Request $request) {
        if ($request->has('back-btn')) {
            return redirect()->route('register');
        }

        $data = $request->validate([
            'region' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'zipcode' => 'required|string|max:20',
            'proof_type' => 'required|string|max:50',
            'proof_files.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        session(['registration.address' => collect($data)->except('proof_files')->toArray()]);

        $files = [];
        if ($request->hasFile('proof_files')) {
            foreach ($request->file('proof_files') as $file) {
                $files[] = $file->store('user_proof', 'public');
            }
        }

        session(['registration.documents' => $files]);

        return redirect()->route('register.account');
    }

    // STEP 3 — Account Info + Final Save
    public function step3(Request $request) {
        if ($request->has('back-btn')) {
            return redirect()->route('register.address');
        }

        $data = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
        ]);

        session([
            'registration.account' => [
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'phone' => $data['phone'] ?? '',
            ]
        ]);

        $reg = session('registration');

        if (!$reg || !isset($reg['personal'], $reg['address'])) {
            return redirect()->route('register')
                ->withErrors(['step' => 'Please complete previous steps.']);
        }

        $brgyName = ucwords(strtolower(trim($reg['address']['barangay'])));
        $cityName = ucwords(strtolower(trim($reg['address']['city'])));
        $provName = ucwords(strtolower(trim($reg['address']['province'])));
        $regName = ucwords(strtolower(trim($reg['address']['region'])));
        $zipCode = trim($reg['address']['zipcode']);

        $firstName = ucwords(strtolower(trim($reg['personal']['given_name'])));
        $middleName = isset($reg['personal']['middle_name'])
                        ? ucwords(strtolower(trim($reg['personal']['middle_name'])))
                        : null;
        $lastName = ucwords(strtolower(trim($reg['personal']['last_name'])));
        $suffix = isset($reg['personal']['suffix'])
                        ? ucwords(strtolower(trim($reg['personal']['suffix'])))
                        : null;

        DB::beginTransaction();

        try {
            $barangay = Barangay::whereRaw('TRIM(brgy_name) = ?', [$brgyName])
                ->whereRaw('TRIM(municipality) = ?', [$cityName])
                ->whereRaw('TRIM(province) = ?', [$provName])
                ->whereRaw('TRIM(region) = ?', [$regName])
                ->where('zip_code', $zipCode)
                ->firstOrFail();

            $resident_id = str_replace(' ', '', $brgyName) . time() . "eMASID";

            $user = User::create([
                'resident_id' => $resident_id,
                'brgy_id' => $barangay->brgy_id,
                'first_name' => $firstName,
                'middle_name' => $middleName,
                'last_name' => $lastName,
                'suffix' => $suffix,
                'gender' => $reg['personal']['gender'],
                'full_address' => ucwords(strtolower(trim($reg['address']['address']))),
                'mobile_number'=> $reg['account']['phone'] ?? '',
                'email' => $reg['account']['email'],
                'password_hash'=> $reg['account']['password'],
            ]);

            // Create verification record
            $verification = UserVerification::create([
                'user_id' => $user->user_id,
                'document_type' => $reg['address']['proof_type'],
                'status' => 'pending',
            ]);

            // Create verification files if any
            if (isset($reg['documents'])) {
                foreach ($reg['documents'] as $filePath) {
                    $fullPath = storage_path('app/public/' . $filePath);
                    $originalName = basename($filePath);
                    $fileSize = filesize($fullPath);
                    $extension = pathinfo($fullPath, PATHINFO_EXTENSION);
                    $fileType = in_array(strtolower($extension), ['pdf']) ? 'pdf' : 'image';

                    UserVerificationFile::create([
                        'verification_id' => $verification->id,
                        'file_path' => $filePath,
                        'original_name' => $originalName,
                        'file_type' => $fileType,
                        'file_size' => $fileSize,
                    ]);
                }
            }

            DB::commit();
            session()->forget('registration');

            return redirect()->route('login')->with('success', 'Account created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('register.error')->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function showStep1() { 
        return view('residentUI.auth.registration'); 
    }

    public function showStep2() { 
        return view('residentUI.auth.set_address'); 
    }

    public function showStep3() { 
        return view('residentUI.auth.set_login'); 
    }

    public function showError() { 
        return view('residentUI.auth.registration_error'); 
    }
}