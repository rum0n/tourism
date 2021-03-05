<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\Report;
use App\Review;
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


}
