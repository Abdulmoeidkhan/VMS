<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseApiController as BaseApiController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Group;

class GroupController extends BaseApiController
{
    public function create(Request $req)
    {
        $groups = new Group();
        $groups->name = $req->name;
        $groups->display_name = $req->display_name;
        $groupsSaved = $groups->save();
        try {
            $groupsSaved = $groups->save();
            return $groupsSaved ? response()->json('Group Added Successfully', 200) : response()->json('Something Went Wrong', 200);
            // return $groupsSaved ? redirect()->route('pages.programs')->with('message', 'Group Added Successfully') : redirect()->route('pages.programs')->with('error', 'Something Went Wrong');
        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json($exception->errorInfo[2], 400);
        }
    }
    public function read(Request $req, $name = null)
    {
        $groups = $name ? Group::where('name', $name)->get() : Group::all();
        // return response()->json($countries, 200);
        return $groups;
    }
    public function update(Request $req) {}
    public function delete(Request $req)
    {
        // return $req;
        try {
            $deletedGroup = Group::where('group_uid', $req->id)->delete();
            return $this->sendResponse($deletedGroup, 'Group Deleted successfully.');
            // return  redirect()->route('pages.essentials')->with('message', 'Group Deleted Successfully');
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
