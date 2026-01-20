@extends('layouts.app')

@section('content')
<div class="card" style="max-width: 600px; margin: 50px auto; text-align: center;">
    <h1 style="color: var(--success); margin-bottom: 20px;">訂房成功！</h1>
    <div style="font-size: 1.2rem; margin-bottom: 30px;">
        <p>房號：{{ $booking->room->name }}</p>
        <p>入住日期：{{ $booking->check_in_date }}</p>
        <p>金額：${{ number_format($booking->room->price) }}</p>
    </div>

    <div style="background: rgba(99, 102, 241, 0.1); padding: 20px; border-radius: 12px; border: 1px solid var(--primary);">
        <h3 style="margin-bottom: 15px;">匯款資料</h3>
        <p style="font-size: 1.1rem; margin-bottom: 10px;"><strong>OO銀行</strong></p>
        <p style="font-size: 1.3rem; letter-spacing: 2px; font-weight: bold; margin-bottom: 10px;">123321</p>
        <p style="color: var(--text-muted);">請於入住前完成匯款</p>
    </div>

    <div style="margin-top: 30px;">
        <a href="{{ route('dashboard') }}" class="btn">查看我的訂房</a>
    </div>
</div>
@endsection
