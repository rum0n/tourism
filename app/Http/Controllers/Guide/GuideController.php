<?php

namespace App\Http\Controllers\Guide;

use App\Booking;
use App\Notifications\BookingAcceptNotification;
use App\Notifications\BookingRejectNotification;
use App\Role;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Intervention\Image\Facades\Image;

class GuideController extends Controller
{
    public function index()
    {
        $local_id = Auth::user()->id;

        $my_bookings = Booking::where('local_id',$local_id)->latest()->get();

        return view('guide.dashboard', compact('my_bookings'));
    }

    public function approve($booking_id)
    {
        $booking = Booking::find($booking_id);

        $booking->status = 'Confirmed';
        $booking->save();


        $fromUser = User::where('id',$booking->local_id)->first();
        $toUser = User::where('id',$booking->traveller_id)->first();

        Notification::send($toUser, new BookingAcceptNotification($fromUser));

        Toastr::success('Trip accepted' ,'Well done !');
        return back();
    }

    public function reject($booking_id)
    {
        $booking = Booking::find($booking_id);

        $booking->status = 'Rejected';
        $booking->save();


        $fromUser = User::where('id',$booking->local_id)->first();
        $toUser = User::where('id',$booking->traveller_id)->first();

        Notification::send($toUser, new BookingRejectNotification($fromUser));

        Toastr::success('has been rejected' ,'Trip !');
        return back();
    }

    public function editProfile($id)
    {
        $user = User::find($id);
        $user_type = Role::where('id','>',1)->get();

        return view('guide.edit_profile',compact('user','user_type'));
    }

    public function updateProfile(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'user_type'=>'required',
            'location'=>'required',
            'phone'=>'nullable|numeric',
            'pro_pic' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

//        dd($request->all());

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
        return redirect()->route('guide.dashboard');
    }


}
