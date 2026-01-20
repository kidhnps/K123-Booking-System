@extends('layouts.app')

@section('content')
<div class="card" style="max-width: 500px; margin: 30px auto;">
    <h2>系統設定</h2>
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>開放訂房天數 (未來幾天內)</label>
            <input type="number" name="booking_window_days" value="{{ $bookingWindowDays }}" required min="1">
            <small style="color: var(--text-muted);">目前設定: {{ $bookingWindowDays }} 天</small>
        </div>
        
        <div class="form-group">
            <label>訂房狀態</label>
            <select name="booking_paused">
                <option value="0" {{ $bookingPaused == 0 ? 'selected' : '' }}>正常開放</option>
                <option value="1" {{ $bookingPaused == 1 ? 'selected' : '' }}>暫停訂房 (維護/休假)</option>
            </select>
            @if($bookingPaused)
                <small style="color: var(--danger);">目前已暫停所有新訂房</small>
            @endif
        </div>
        
        <button type="submit" class="btn">儲存設定</button>
    </form>
</div>
@endsection
