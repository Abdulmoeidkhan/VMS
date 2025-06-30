<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseApiController as BaseApiController;
use Illuminate\Support\Facades\Validator;
use App\Models\GovernmentStaff;
use Illuminate\Http\Request;

class GovernmentStaffController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ?string $orgId = '')
    {
        $govtOrganizationStaff = GovernmentStaff::where('status', 1)->with(['rank', 'invited_by', 'country', 'staff_category'])->get();

        if ($request->expectsJson()) {
            try {
                return $this->sendResponse($govtOrganizationStaff, 'Government Organization Staff Retrieved successfully' . ($govtOrganizationStaff->count() ? '.' : ', No Data Exist'), 'table');
            } catch (\Illuminate\Database\QueryException $exception) {
                return response()->json($exception->errorInfo[2], 400);
            }
        }

        return view('pages.govtStaff', ['orgId' => $orgId]);
        // return view('pages.govtOrganization', ['govtOrganization' => $govtOrganization]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $orgId)
    {
        return view('pages.addGovtStaff', ['orgId' => $orgId]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:30',
            'rank' => 'required|string|max:36',
            'designation' => 'required|string|max:255',
            'identity' => 'required|string|max:16',
            'address' => 'string|max:255',
            'contact' => 'required|string|regex:/^\d{11,20}$/',
            'invited_by' => 'required|integer',
            'staff_category' => 'required|integer',
            'country' => 'required|string|max:30',
            'city' => 'required|string|max:30',
            'car_sticker_color' => 'required|string|max:20',
            'car_sticker_no' => 'required|string|max:20',
            'invitaion_no' => 'required|string|max:200',
        ]);

        // return $validator->validated();
        try {
            $govtStaff = GovernmentStaff::create($validator->validated());
            return $this->sendResponse($govtStaff, 'Government Staff Created successfully.');
        } catch (\Illuminate\Database\QueryException $ex) {
            // Handle specific database errors
            if ($ex->getCode() == 23000) { // Duplicate entry error (unique constraint violation)
                return $this->sendError('Database Error: Something Went Wrong.', $ex->getMessage(), 422);
            }
            // General database error
            return $this->sendError('Database Error.', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(GovernmentStaff $governmentStaff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GovernmentStaff $governmentStaff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GovernmentStaff $governmentStaff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GovernmentStaff $governmentStaff)
    {
        //
    }
}
