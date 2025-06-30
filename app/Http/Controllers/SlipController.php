<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Visitors;
use Illuminate\Http\Request;

class SlipController extends Controller
{
    public function render(Request $req, $identity)
    {
        $visitors = Visitors::where('identity', $identity)->get();
        return view('pages.slips', ['data' => $visitors]);
    }
}
