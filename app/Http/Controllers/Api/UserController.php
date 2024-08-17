<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Get list of users per page
    public function getPerPage(Request $request)
    {
        $page = $request->query('page', 1);
        $perPage = 10;

        $users = User::orderBy('name', 'asc')->paginate($perPage, ['*'], 'page', $page);

        return response()->json($users);
    }
}
