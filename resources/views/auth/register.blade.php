@extends('layouts.app')

@section('content')
<div class="card" style="max-width: 400px; margin: 50px auto;">
    <h2 style="text-align: center; margin-bottom: 20px;">註冊會員</h2>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>帳號</label>
            <input type="text" name="username" value="{{ old('username') }}" required>
            @error('username') <span style="color:red">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email') <span style="color:red">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label>密碼</label>
            <input type="password" name="password" required>
            @error('password') <span style="color:red">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label>驗證碼</label>
            <div style="display: flex; gap: 10px; align-items: stretch;">
                <input type="text" name="captcha" required style="flex: 1; width: auto; min-width: 0;">
                <img src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" style="cursor: pointer; height: 45px; border-radius: 8px;" title="點擊重新整理">
            </div>
            @error('captcha') <span style="color:red">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn" style="width: 100%;">註冊</button>
    </form>
</div>
@endsection
