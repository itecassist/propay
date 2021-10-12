<?php

namespace App\Http\Controllers;

use App\Notifications\CandidateCreated;
use Illuminate\Http\Request;
use App\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}
