@extends('layouts.common')

@section('title', '郵便番号検索')

@section('content')
    <h1 class="h2">郵便番号検索</h1>
    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('customers.create') }}" method="get">
        <div class="form-group">
            <label for="zipcode" class="fs-4">郵便番号</label>
            <input value="{{ old('zipcode') }}" class="form-control" type="text" name="zipcode"
                placeholder="検索したい郵便番号(ハイフンなし数字7桁)   例･･1234567" required autofocus maxlength="7">
            <input class="btn btn-outline-primary" type="submit" value="検索">
            <button class="btn btn-secondary" type="button"
                onclick="location=href='{{ route('customers.index') }}'">一覧に戻る</button>
        </div>
    </form>
@endsection
