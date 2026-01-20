<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\Room;
use App\Models\SystemSetting;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $bookings = Booking::with(['user', 'room'])->orderBy('check_in_date', 'desc')->get();
        return view('admin.dashboard', compact('bookings'));
    }

    public function status(Request $request)
    {
        $date = $request->input('date', date('Y-m-d'));
        
        $bookings = Booking::where('check_in_date', $date)->get()->keyBy('room_id');
        $rooms = Room::all()->map(function($room) use ($bookings) {
            $booking = $bookings->get($room->id);
            $room->status = $booking ? 'booked' : 'available';
            $room->booking = $booking;
            return $room;
        });

        return view('admin.status', compact('rooms', 'date'));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function editUser(User $user)
    {
        return view('admin.user_edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|unique:users,username,'.$user->id,
            'role' => 'required',
        ]);

        $user->username = $request->username;
        $user->role = $request->role;
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();

        return redirect()->route('admin.users')->with('success', '會員資料已更新');
    }

    public function editBooking(Booking $booking)
    {
        return view('admin.booking_edit', compact('booking'));
    }

    public function updateBooking(Request $request, Booking $booking)
    {
        $request->validate([
            'check_in_date' => 'required|date',
            'status' => 'required',
        ]);

        $booking->check_in_date = $request->check_in_date;
        $booking->status = $request->status;
        $booking->save();

        return redirect()->route('admin.dashboard')->with('success', '訂房資料已更新');
    }

    public function destroyBooking(Booking $booking)
    {
        $booking->delete();
        return back()->with('success', '訂房已刪除');
    }

    // Settings
    public function settings()
    {
        $bookingWindowDays = SystemSetting::getValue('booking_window_days', 14);
        $bookingPaused = SystemSetting::getValue('booking_paused', 0);

        return view('admin.settings', compact('bookingWindowDays', 'bookingPaused'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'booking_window_days' => 'required|integer|min:1',
            'booking_paused' => 'required|boolean',
        ]);

        SystemSetting::setValue('booking_window_days', $request->booking_window_days);
        SystemSetting::setValue('booking_paused', $request->booking_paused);

        return redirect()->route('admin.settings')->with('success', '系統設定已更新');
    }
}
