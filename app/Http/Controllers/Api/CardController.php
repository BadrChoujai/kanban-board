<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Card;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $created = $request->created;
        $active = $request->active;
        $cards =  Card::whereDate('created_at', '=', Carbon::parse($created)->format('Y-m-d'));
        $cards = $active ? $cards->whereNull('deleted_at')->get() : $cards->whereNotNull('deleted_at')->get();

        return response()->json([
            'data' => $cards
        ]);
    }
}
