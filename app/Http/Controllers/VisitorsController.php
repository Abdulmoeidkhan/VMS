<?php

namespace App\Http\Controllers;

use App\Models\Visitors;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class VisitorsController extends Controller
{

    protected function badge($characters, $prefix)
    {
        $possible = '0123456789';
        $code = $prefix;
        $i = 0;
        while ($i < $characters) {
            $code .= substr($possible, mt_rand(0, strlen($possible) - 1), 1);
            if ($i < $characters - 1) {
                $code .= "";
            }
            $i++;
        }
        return $code;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Visitors::all();
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        // return 'Request recieved from livewire';
        $validated = $request->validate([
            'name' => 'required|min:3',
            'dob' => 'required|date|before_or_equal:' . Carbon::now()->subYears(18)->toDateString(),
            'designation' => 'required|min:3',
            'identity' => 'required|min:3',
        ]);

        $visitors = Visitors::create([
            'uid' => (string) Str::uuid(),
            ...$validated,
            'code' => $this->badge(6, 'TVFA'),
        ]);

        return $visitors ? response()->json([
            'message' => 'Visitor created successfully',
            'item' => $visitors
        ], 200) : response()->json([
            'message' => 'Visitor creation Failed',
            'item' => $visitors
        ], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Visitors $visitors)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visitors $visitors)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Visitors $visitors)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visitors $visitors)
    {
        //
    }
}
