<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseApiController as BaseApiController;
use Illuminate\Support\Facades\Validator;
use App\Models\Coupons;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CouponsController extends BaseApiController
{

    public function couponsData()
    {
        $coupon = Coupons::get();
        return $coupon;
    }

    public function addCouponPages()
    {
        return view("pages.addCoupon");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addCoupon(Request $req)
    {
        // $coupon = new Coupons();
        // $coupon->coupon_uid = (string) Str::uuid();
        // foreach ($req->all() as $key => $value) {
        //     if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
        //         $coupon[$key] = $value;
        //     }
        // }

        // try {
        //     $savedCoupon = $coupon->save();
        //     return $savedCoupon ? redirect()->route('pages.snseaEssentials')->with('message', 'Coupon Added Successfully') : redirect()->route('pages.snseaEssentials')->with('error', 'Something Went Wrong');
        // } catch (\Illuminate\Database\QueryException $exception) {
        //     return redirect()->route('pages.snseaEssentials')->with('error', $exception->errorInfo[2]);
        // }

        $validator = Validator::make($req->all(), [
            'coupon_name' => 'required|string|max:255',
            'coupon_day' => 'required|integer|max:4',
            'coupon_validity_start_time' => 'required|string|max:2359',
            'coupon_validity_end_time' => 'required|string|max:2359',
        ]);

        try {
            $coupon = Coupons::create($validator->validated());
            return $this->sendResponse($coupon, 'Coupon Created successfully.');
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
     * Remove the specified resource from storage.
     */
    public function deleteCoupon(Request $req)
    {
        try {
            $deleteCoupon = Coupons::where('coupon_uid', $req->id)->delete();
            return $this->sendResponse($deleteCoupon, 'Coupon Deleted successfully.');
        } catch (\Illuminate\Database\QueryException $exception) {
            // Handle specific database errors
            if ($exception->getCode() == 23000) { // Duplicate entry error (unique constraint violation)
                return $this->sendError('Database Error: Something Went Wrong.', $exception->getMessage(), 422);
            }
            // General database error
            return $this->sendError('Database Error.', $exception->getMessage());
        }
    }
}
