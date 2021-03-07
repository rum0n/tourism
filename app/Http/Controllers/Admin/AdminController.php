<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\Report;
use App\Review;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $bookings = Booking::latest()->get();
        return view('admin.dashboard', compact('bookings'));
    }

    public function reviews()
    {
        $reviews = Review::latest()->get();
        return view('admin.reviews', compact('reviews'));
    }

    public function reports()
    {
        $reports = Report::latest()->get();
        return view('admin.reports', compact('reports'));
    }

    public function delete_review($id)
    {
        $review = Review::find($id);
        $review->delete();

        Toastr::success('Successfully deleted !' ,'Review');
        return redirect()->back();
    }

    public function delete_report($id)
    {
        $report = Report::find($id);
        $report->delete();

        Toastr::success('Successfully deleted !' ,'Report');
        return redirect()->back();
    }



}
