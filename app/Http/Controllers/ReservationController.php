<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Reservation;
use App\Search\ReservationSearch;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Search\QueryParser;

class ReservationController extends Controller
{
    /**
     * 予約一覧画面表示
     * @param int $id
     * @return \Inertia\Response
     */
    public function index(int $id, Request $request)
    {
        $query = QueryParser::parse(new ReservationSearch());
        $reservations = Reservation::search(new ReservationSearch(), $query)
            ->where('facility_id', $id)
            ->with('user')
            ->get();
        return Inertia::render('Reservation/Index', [
            'reservations' => $reservations,
            'facility' => Facility::find($id),
            'subscriber' => $request->subscriber ?? null,
            'start_time' => $request->start_time ?? null,
        ]);
    }
}
