<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseApiController as BaseApiController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Cities;

class CitiesController extends BaseApiController
{
    public function create(Request $req)
    {
        $cities = new Cities();
        $cities->name = $req->name;
        $cities->display_name = $req->display_name;
        $citiesSaved = $cities->save();
        try {
            $citiesSaved = $cities->save();
            return $citiesSaved ? response()->json('City Added Successfully', 200) : response()->json('Something Went Wrong', 200);
            // return $citiesSaved ? redirect()->route('pages.programs')->with('message', 'City Added Successfully') : redirect()->route('pages.programs')->with('error', 'Something Went Wrong');
        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json($exception->errorInfo[2], 400);
        }
    }
    public function read(Request $req, $name = null)
    {
        $cities = $name ? Cities::where('name', $name)->get() : Cities::all();
        // return response()->json($countries, 200);
        return $cities;
    }
    public function update(Request $req) {}
    public function delete(Request $req)
    {

        try {
            $deleteCities = Cities::where('id', $req->id)->delete();
            return $this->sendResponse($deleteCities, 'City Deleted successfully.');
            return response()->json("Country Deleted Successfully", 200);
            // return  redirect()->route('pages.essentials')->with('message', 'Country Deleted Successfully');
        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json($exception->errorInfo[2], 400);
            // return redirect()->route('pages.programs')->with('error', $exception->errorInfo[2]);
        }
    }
}
