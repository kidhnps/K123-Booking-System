@extends('layouts.app')

@section('content')
<div class="card" style="margin-top: 50px; text-align: center;">
    <img src="{{ asset('images/logo.png') }}" alt="K123 Logo" style="width: 120px; margin-bottom: 20px; border-radius: 20px; box-shadow: 0 0 20px rgba(99, 102, 241, 0.3);">
    <h1 style="font-size: 2.5rem; background: linear-gradient(to right, #818cf8, #c084fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-bottom: 30px;">
        歡迎來到 K123 訂房系統
    </h1>
    
    <div style="max-width: 500px; margin: 0 auto 50px;">
        <h3 style="margin-bottom: 20px;">預約您的完美假期</h3>
        <form action="{{ route('booking.search') }}" method="GET" id="bookingForm">
            <!-- Hidden input to store value -->
            <input type="hidden" name="check_in_date" id="check_in_date" required>
            
            <div style="display: flex; flex-direction: column; gap: 20px; align-items: center;">
                <!-- Calendar container -->
                <div id="calendar-container" style="background: var(--bg-card); padding: 10px; border-radius: 12px; border: 1px solid var(--border);"></div>
                
                <button type="submit" class="btn" style="width: 200px; font-size: 1.1rem;">查詢空房</button>
            </div>
        </form>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                flatpickr("#calendar-container", {
                    inline: true, // Always visible
                    minDate: "today",
                    maxDate: new Date().fp_incr({{ $bookingWindowDays }}), 
                    dateFormat: "Y-m-d",
                    defaultDate: "today",
                    onChange: function(selectedDates, dateStr, instance) {
                        document.getElementById('check_in_date').value = dateStr;
                    }
                });
                // Set initial value
                document.getElementById('check_in_date').value = new Date().toISOString().split('T')[0];
            });
        </script>
        <p style="margin-top: 10px; color: var(--text-muted); font-size: 0.9rem;">
            @if($bookingPaused)
                <span style="color: var(--danger); font-weight: bold;">目前暫停訂房</span>
            @else
                開放未來 {{ $bookingWindowDays }} 天內的訂房
            @endif
        </p>
    </div>

    <h3 style="text-align: left; margin-bottom: 20px;">精選房型</h3>
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
                <div style="color: var(--text-muted); font-size: 0.9rem; min-height: 45px;">
                    {{ $descriptions[$room->id % count($descriptions)] }}
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
