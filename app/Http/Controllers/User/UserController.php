<?php

namespace App\Http\Controllers\User;

use App\Booking;
use App\Notifications\BookingNotification;
use App\Role;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

    public function index()
    {
        $user_id = Auth::user()->id;

        $my_trips = Booking::where('traveller_id',$user_id)->latest()->get();

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

        $fromUser = User::find($traveller_id);
        $toUser = User::find($local_id);

        Notification::send($toUser, new BookingNotification($fromUser));


        Toastr::success('Successfully Added !' ,'Trip');
        return redirect()->route('user.dashboard');
    }


    public function destroy($booking_id)
    {

        $trip = Booking::find($booking_id);
        $trip->delete();

        Toastr::success('Successfully deleted !' ,'Trip');
        return redirect()->back();
    }

    public function editProfile($id)
    {
        $user = User::find($id);
        $user_type = Role::where('id','>',1)->get();

        return view('user.edit_profile',compact('user','user_type'));
    }

    public function updateProfile(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'user_type'=>'required',
            'location'=>'required',
            'phone'=>'numeric',
            'pro_pic' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->user_type;
        $user->phone = $request->phone;
        $user->price = $request->price;
        $user->motto = $request->motto;
        $user->about = $request->about;
        $user->location = $request->location;

        if($request->hasFile('pro_pic')){


            $pic = $request->file('pro_pic');
            $file_name = $request->name.$id.'.'.$pic->getClientOriginalExtension();

            if($user->pro_pic=='default.png'){
                $user->pro_pic = $file_name;
            }
            else{
                $path = public_path('profile/picture/'.$user->pro_pic);
                unlink($path);

                $user->pro_pic = $file_name;
            }
//            $destination = public_path('profile/picture/');
//            $pic->move($destination, $file_name);

            Image::make($pic)->resize(300,300)->save(public_path('profile/picture/'.$file_name));
        }

        $user->save();

        Toastr::success('Successfully Updated !' ,'Profile');
        return redirect()->route('user.dashboard');
    }



}
