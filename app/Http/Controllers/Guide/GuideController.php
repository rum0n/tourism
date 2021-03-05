<?php

namespace App\Http\Controllers\Guide;

use App\Booking;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GuideController extends Controller
{
    public function index()
    {
        $local_id = Auth::user()->id;

        $my_bookings = Booking::where('local_id',$local_id)->get();

        return view('guide.dashboard', compact('my_bookings'));
    }

    public function approve($booking_id)
    {
        $booking = Booking::find($booking_id);

        $booking->status = 'Confirmed';
        $booking->save();

        Toastr::success('Trip accepted' ,'Well done !');
        return back();
    }

    public function reject($booking_id)
    {
        $booking = Booking::find($booking_id);

        $booking->status = 'Rejected';
        $booking->save();

        Toastr::success('has been rejected' ,'Trip !');
        return back();
    }


}
