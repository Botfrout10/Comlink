<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Booking;
use App\Models\Commercial;
use Illuminate\Http\Request;

class FullCalenderController extends Controller
{
    public function index()
    {
        if (auth()->user()->admin) {
            $admin = Admin::where('email', auth()->user()->email)->first();
            $comms = $admin->commercial;
            $events = array();
            foreach ($comms as $comm) {
                foreach ($comm->prospect as $pros) {
                    foreach ($pros->booking as $bookin) {
                        $events[] = [
                            'id'   => $bookin->id,
                            'title' => $bookin->title,
                            'start' => $bookin->start_date,
                            'end' => $bookin->end_date,
                            'color' => $bookin->color,
                        ];
                    }
                }
            }
        } else {
            $comm = Commercial::where('email', auth()->user()->email)->first();
            $pros = $comm->prospect;
            $events = array();
            foreach ($pros as $p) {
                foreach ($p->booking as $bookin) {
                    $events[] = [
                        'id'   => $bookin->id,
                        'title' => $bookin->title,
                        'start' => $bookin->start_date,
                        'end' => $bookin->end_date,
                        'color' => $bookin->color,
                    ];
                }
            }
        }
        return view('pages.calender', ['events' => $events]);
    }


    //Not used
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string'
        ]);

        $booking = Booking::create([
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'color' => $request->color,
        ]);


        return response()->json([
            'id' => $booking->id,
            'start' => $booking->start_date,
            'end' => $booking->end_date,
            'title' => $booking->title,
            'color' => $booking->color,
        ]);
    }
    public function update(Request $request, $id)
    {
        dd($id);
        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $booking->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return response()->json('Event updated');
    }
    public function destroy($id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $booking->delete();
        return $id;
    }
}
