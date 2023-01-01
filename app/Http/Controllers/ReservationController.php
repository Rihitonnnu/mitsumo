<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Reservation;
use Inertia\Inertia;

class ReservationController extends Controller
{
    /**
     * 予約一覧画面表示
     * @param int $id
     * @return \Inertia\Response
     */
    public function index(int $id)
    {
        return Inertia::render('Reservation/Index',[
            'reservations'=>Reservation::where('facility_id',$id)->with(['user'])->get(),
            'facility_name'=>Facility::find($id)->name,
        ]);
    }
}
