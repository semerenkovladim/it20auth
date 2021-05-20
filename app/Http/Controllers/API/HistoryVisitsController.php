<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\HistoryVisits;
use Illuminate\Http\Request;

class HistoryVisitsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $historyVisits = HistoryVisits::where('user_id', $request->user()->id)->orderBy('id', 'DESC')->paginate(10);
//        $grouped = collect($historyVisits->data)->groupBy('date_history');
//        $historyVisits->data = $grouped;
        $historyVisitsArray = collect($historyVisits->items());
        return response()->json(
            [
                'dataPaginate' => $historyVisits,
                'dataArray' => $historyVisitsArray
            ], 200);
    }
}
