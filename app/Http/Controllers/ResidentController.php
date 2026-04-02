<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ResidentController extends Controller
{
    public function index() {
        /** @var User $user */
        
        $user = Auth::user();

        $user->load('barangay');

        return view('residentUI.userNav.home', compact('user'));
    }
}