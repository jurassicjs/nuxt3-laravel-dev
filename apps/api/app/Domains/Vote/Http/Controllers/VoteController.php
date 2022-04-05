<?php

namespace App\Domains\Vote\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function getCount(Request $request)
    {
       return response()->json(['count' => 5]);
    }
}
