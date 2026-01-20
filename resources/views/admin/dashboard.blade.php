@extends('layouts.app')

@section('content')
<div style="margin-bottom: 20px;">
    <h1>管理員後台 - 訂房列表</h1>
</div>

<div class="card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>訂房人</th>
                    <th>房號</th>
                    <th>日期</th>
                    <th>狀態</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->user->name }} ({{ $booking->user->username }})</td>
                    <td>{{ $booking->room->name }}</td>
                    <td>{{ $booking->check_in_date }}</td>
                    <td>
                        @if($booking->status == 'booked')
                            <span class="status-available">已訂</span>
                        @else
                            <span class="status-booked">取消</span>
                        @endif
                    </td>
                    <td>
                       <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn" style="padding: 5px 10px; font-size: 0.8rem;">編輯</a>
                       <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('確定刪除？');">
                           @csrf
                           @method('DELETE')
                           <button class="btn btn-danger" style="padding: 5px 10px; font-size: 0.8rem;">刪除</button>
                       </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
