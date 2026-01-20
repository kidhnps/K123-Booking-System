@extends('layouts.app')

@section('content')
<div class="card" style="max-width: 500px; margin: 50px auto;">
    <h2 style="text-align: center; margin-bottom: 20px;">預約訂房</h2>
    <p style="text-align: center; color: var(--text-muted); margin-bottom: 20px;">請選擇入住日期（未來 2 星期內）</p>
    
    <form action="{{ route('booking.search') }}" method="GET">
        <div class="form-group">
            <label>入住日期</label>
            <input type="date" name="check_in_date" 
                   min="{{ date('Y-m-d') }}" 
                   max="{{ date('Y-m-d', strtotime('+14 days')) }}" 
                   required>
        </div>
        <button type="submit" class="btn" style="width: 100%;">查詢空房</button>
    </form>
</div>
@endsection
