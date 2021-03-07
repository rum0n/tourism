<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Notifications\ReportNotification;
use App\Notifications\ReviewNotification;
use App\Report;
use App\Review;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class FrontController extends Controller
{
    public function index()
    {
        $local_guides = User::where('role_id',2)
                        ->where('is_approved','>',0)
                        ->where('email_verified_at','!=','')
                        ->paginate(4);

        $recent_bookings = Booking::latest()->paginate(3);


        return view('welcome', compact('local_guides','recent_bookings'));
    }

    public function bookings()
    {
        $recent_bookings = Booking::latest()->paginate(6);

        return view('bookings', compact('recent_bookings'));
    }


    public function find_local(Request $request)
    {
        $todayDate = date('m/d/Y');
        $this->validate($request,[
            'location'=>'required',
            'date'=>'required|after_or_equal:'.$todayDate,

        ]);

        $search_location =$request->location;
        $search_date =$request->date;

        $booked = Booking::where('date',$request->date)
                ->where('status','Confirmed')
                ->get('local_id')->toArray();

        $local_guides = User::where('role_id',2)
                    ->whereNotIn('id',$booked)
                    ->where('location', 'LIKE', "%{$request->location}%")
                    ->get();

        return view('search', compact('local_guides','search_location','search_date'));
    }


    public function local($id)
    {
        $local = User::find($id);

        $reviews = Review::where('profile_id',$id)->get();

        return view('local_details', compact('local','reviews'));
    }


    public function review(Request $request, $profile_id)
    {
        $this->validate($request,[
            'rating'=>'required',
            'review'=>'required',

        ]);
//       dd($request->all());

        $user_id = Auth::user()->id;

        $new_review = new Review();

        $new_review->profile_id = $profile_id;
        $new_review->user_id = $user_id;
        $new_review->rating = $request->rating;
        $new_review->review = $request->review;
        $new_review->save();

        $toUser = User::find($profile_id);
        $fromUser = User::find($user_id);

        Notification::send($toUser, new ReviewNotification($fromUser));

        Toastr::success('Successfully Added !' ,'Review');
        return redirect()->back();
    }

    public function report(Request $request, $profile_id)
    {
        $this->validate($request,[
            'report'=>'required',
        ]);

        $reporter_id = Auth::user()->id;

        $new_report = new Report();

        $new_report->profile_id = $profile_id;
        $new_report->reporter_id = $reporter_id;
        $new_report->report = $request->report;

        $new_report->save();

        $reportedTo = User::find($profile_id);
        $fromUser = User::find($reporter_id);
        $toAdmins = User::where('role_id',1)->get();

        if(count($toAdmins) > 0)
        {
            foreach($toAdmins as $admin)
            {
                Notification::send($admin, new ReportNotification($fromUser,$reportedTo));
            }

        }


        Toastr::success('Report send to admin !' ,'Done!');
        return redirect()->back();
    }



}
