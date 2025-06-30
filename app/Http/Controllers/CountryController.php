<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseApiController as BaseApiController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends BaseApiController
{
    public function create(Request $req)
    {
        $country = new Country();
        $country->name = $req->name;
        $country->display_name = $req->display_name;
        $countrySaved = $country->save();
        try {
            $countrySaved = $country->save();
            return $countrySaved ? response()->json('Country Added Successfully', 200) : response()->json('Something Went Wrong', 200);
            // return $countrySaved ? redirect()->route('pages.programs')->with('message', 'Country Added Successfully') : redirect()->route('pages.programs')->with('error', 'Something Went Wrong');
        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json($exception->errorInfo[2], 400);
        }
    }
    public function read(Request $req, $name = null)
    {
        $countries = $name ? Country::where('name', $name)->get() : Country::all();
        // return response()->json($countries, 200);
        return $countries;
    }
    public function update(Request $req) {
        
    }
    public function delete(Request $req)
    {
        try {
            $deleteCountry = Country::where('id', $req->id)->delete();
            return $this->sendResponse($deleteCountry, 'Country Deleted successfully.');
            return response()->json("Country Deleted Successfully", 200);
            // return  redirect()->route('pages.essentials')->with('message', 'Country Deleted Successfully');
        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json($exception->errorInfo[2], 400);
            // return redirect()->route('pages.programs')->with('error', $exception->errorInfo[2]);
        }

    }
}
