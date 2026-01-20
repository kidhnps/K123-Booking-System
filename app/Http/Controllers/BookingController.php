<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use App\Models\SystemSetting;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())->orderBy('check_in_date')->get();
        return view('booking.index', compact('bookings'));
    }

    public function home()
    {
        // Fetch configurations
        $bookingWindowDays = SystemSetting::getValue('booking_window_days', 14);
        $bookingPaused = SystemSetting::getValue('booking_paused', 0);
        
        $rooms = Room::limit(6)->get(); // Show some rooms

        return view('home', compact('rooms', 'bookingWindowDays', 'bookingPaused'));
    }

    public function search(Request $request)
    {
        // Check if paused
        if (SystemSetting::getValue('booking_paused', 0)) {
            return redirect()->route('home')->with('error', '目前暫停訂房，請稍後再試。');
        }

        $bookingWindowDays = SystemSetting::getValue('booking_window_days', 14);

        $request->validate([
            'check_in_date' => 'required|date|after:today|before_or_equal:+'.$bookingWindowDays.' days',
        ]);

        $date = $request->check_in_date;
        
        // Find rooms NOT booked on this date
        $bookedRoomIds = Booking::where('check_in_date', $date)
            ->where('status', 'booked')
            ->pluck('room_id');

        $rooms = Room::whereNotIn('id', $bookedRoomIds)->get();

        return view('booking.result', compact('rooms', 'date'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', '請先登入會員');
        }

        // Check if paused
        if (SystemSetting::getValue('booking_paused', 0)) {
            return redirect()->route('home')->with('error', '目前暫停訂房，請稍後再試。');
        }

        $bookingWindowDays = SystemSetting::getValue('booking_window_days', 14);

        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|after:today|before_or_equal:+'.$bookingWindowDays.' days',
        ]);

        // Check availability again
        $exists = Booking::where('room_id', $request->room_id)
            ->where('check_in_date', $request->check_in_date)
            ->where('status', 'booked')
            ->exists();

        if ($exists) {
            return back()->with('error', '該房間已被預訂');
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'check_in_date' => $request->check_in_date,
            'status' => 'booked',
        ]);

        return redirect()->route('booking.success', $booking->id);
    }

    public function success(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }
        return view('booking.success', compact('booking'));
    }

    public function destroy(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $checkIn = Carbon::parse($booking->check_in_date);
        $today = Carbon::today();

        // Must cancel 2 days before
        $diff = $today->diffInDays($checkIn, false); // false ensures negative if past

        if ($diff < 2) {
            return back()->with('error', '你應該2天前退房,謝謝');
        }

        $booking->delete();

        return back()->with('success', '訂房已取消');
    }
}
