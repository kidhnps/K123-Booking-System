@extends('layouts.app')

@section('content')
<div style="margin-bottom: 20px;">
    <h1>{{ $date }} 可預訂房間</h1>
    <a href="{{ route('booking.create') }}" style="color: var(--text-muted);">← 重選日期</a>
</div>

@if($rooms->isEmpty())
    <div class="card" style="text-align: center;">
        <p>抱歉，該日期已無空房。</p>
    </div>
@else
    <div class="rooms-grid">
        @php
            $descriptions = [
                '擁有絕佳視野的景觀房，讓您盡收眼底。',
                '溫馨舒適的小天地，適合獨自享受寧靜時光。',
                '豪華寬敞的空間，家庭旅遊的最佳選擇。',
                '充滿藝術氣息的設計風格，處處是驚喜。',
                '簡約現代的裝潢，帶給您最純粹的放鬆。',
                '配備頂級寢具，保證您一夜好眠。',
                '採光充足的明亮空間，早晨被陽光喚醒。',
                '靜謐優雅的氛圍，遠離塵囂的理想之所。',
                '寬敞的浴室與獨立浴缸，洗去一身疲憊。',
                '設有專屬陽台，享受午後悠閒的午茶時光。',
                '結合在地元素的特色房型，體驗在地文化。',
                '不管是商務出差還是休閒旅遊，都是完美首選。',
                '高樓層視野，將城市美景盡收眼底。',
                '溫暖的木質調設計，營造家的溫馨感。',
                '智慧化的房間設備，科技與舒適的完美結合。'
            ];
        @endphp
        @foreach($rooms as $room)
            <div class="room-card">
                <div class="room-name">{{ strtoupper($room->name) }}</div>
                <div class="room-price">${{ number_format($room->price) }}</div>
                <div style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 15px; min-height: 45px;">
                    {{ $descriptions[$room->id % count($descriptions)] }}
                </div>
                <form action="{{ route('booking.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $room->id }}">
                    <input type="hidden" name="check_in_date" value="{{ $date }}">
                    <button type="submit" class="btn">立即預訂</button>
                </form>
            </div>
        @endforeach
    </div>
@endif
@endsection
