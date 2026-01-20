@extends('layouts.app')

@section('content')
<div class="card" style="max-width: 500px; margin: 30px auto;">
    <h2>編輯訂房 #{{ $booking->id }}</h2>
    <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>入住日期</label>
            <input type="date" name="check_in_date" value="{{ $booking->check_in_date }}" required>
        </div>
        <div class="form-group">
            <label>狀態</label>
            <select name="status">
                <option value="booked" {{ $booking->status == 'booked' ? 'selected' : '' }}>Booked</option>
                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>
        <button type="submit" class="btn">更新</button>
    </form>
</div>
@endsection
