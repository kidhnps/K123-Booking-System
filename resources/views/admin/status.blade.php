@extends('layouts.app')

@section('content')
<div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
    <h1>每日房況表</h1>
    <form action="{{ route('admin.status') }}" method="GET" style="display: flex; gap: 10px;">
        <input type="date" name="date" value="{{ $date }}" onchange="this.form.submit()" style="padding: 8px;">
    </form>
</div>

<div class="rooms-grid">
    @foreach($rooms as $room)
        <div class="room-card" style="border-color: {{ $room->status == 'booked' ? 'var(--danger)' : 'var(--success)' }}">
            <div class="room-name">{{ strtoupper($room->name) }}</div>
            @if($room->status == 'booked')
                <div style="color: var(--danger); font-weight: bold;">已預訂</div>
                <div style="font-size: 0.9rem; margin-top: 5px;">
                    {{ $room->booking->user->username }}
                </div>
            @else
                <div style="color: var(--success); font-weight: bold;">空房</div>
            @endif
        </div>
    @endforeach
</div>
@endsection
