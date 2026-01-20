@extends('layouts.app')

@section('content')
<div class="card" style="max-width: 500px; margin: 30px auto;">
    <h2>編輯會員 {{ $user->username }}</h2>
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>帳號</label>
            <input type="text" name="username" value="{{ $user->username }}" required>
        </div>
        <div class="form-group">
            <label>角色</label>
            <select name="role">
                <option value="member" {{ $user->role == 'member' ? 'selected' : '' }}>Member</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        <div class="form-group">
            <label>重設密碼 (留空則不修改)</label>
            <input type="text" name="password" placeholder="輸入新密碼">
        </div>
        <button type="submit" class="btn">更新</button>
    </form>
</div>
@endsection
