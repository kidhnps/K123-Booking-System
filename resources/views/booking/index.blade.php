@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h1>我的訂房</h1>
    <a href="{{ route('booking.create') }}" class="btn">＋ 預約訂房</a>
</div>

<div class="card">
    @if($bookings->isEmpty())
        <p style="text-align: center; color: var(--text-muted);">目前沒有訂房紀錄</p>
    @else
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>房號</th>
                        <th>房價</th>
                        <th>入住日期</th>
                        <th>狀態</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->room->name }}</td>
                        <td>${{ number_format($booking->room->price) }}</td>
                        <td>{{ $booking->check_in_date }}</td>
                        <td>
                            @if($booking->status == 'booked')
                                <span class="status-available">已預訂</span>
                            @else
                                <span class="status-booked">已取消</span>
                            @endif
                        </td>
                        <td>
                            @if($booking->status == 'booked')
                                <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('確定要退房嗎？');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 5px 10px; font-size: 0.8rem;">退房</button>
                                </form>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
