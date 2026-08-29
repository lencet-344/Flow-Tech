<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PremiumController extends Controller
{
    public function success(): View
    {
        return view('premium.success');
    }
}
