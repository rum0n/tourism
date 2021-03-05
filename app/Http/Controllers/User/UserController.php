<?php

namespace App\Http\Controllers\User;

use App\Booking;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        $user_id = Auth::user()->id;

        $my_trips = Booking::where('traveller_id',$user_id)->get();

        return view('user.dashboard',compact('my_trips'));
    }

    public function trips($id)
    {
        $local = User::find($id);
        $booked_dates = Booking::where('local_id', $id)->get('date');

        if($booked_dates->isEmpty()){
            $booked='0';
            return view('user.create_trip',compact('local','booked'));
        }
        else{
            foreach ($booked_dates as $date) {
                $b_date[] = $date->date;
            }
            $booked = implode("|",$b_date);

            return view('user.create_trip',compact('local','booked'));
        }

    }


    public function createTrip(Request $request,$local_id)
    {
        $this->validate($request,[
            'date'=>'required',

        ]);
        $traveller_id = Auth::user()->id;
        $traveller_booked = Booking::where('traveller_id', $traveller_id)
                            ->where('date',$request->date)
                            ->get();

        if(count($traveller_booked) != 0){
            Toastr::warning('You already have a trip on this date !' ,'Failed');
            return redirect()->back();
        }

        $booking = new Booking();

        $booking->local_id = $local_id;
        $booking->traveller_id = $traveller_id;
        $booking->location = $request->location;
        $booking->date = $request->date;
        $booking->status = 'Pending';
        $booking->traveller_number  = $request->numberOfPeople;

        $booking->save();

        Toastr::success('Successfully Added !' ,'Trip');
        return redirect()->back();
    }

    public function destroy($booking_id)
    {
//        dd($booking_id);

        $trip = Booking::find($booking_id);
        $trip->delete();

        Toastr::success('Successfully deleted !' ,'Trip');
        return redirect()->back();
    }


}
