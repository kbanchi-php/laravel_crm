@extends('layouts.common')

@section('title', '新規登録')

@section('content')
    <h1 class="h2">新規登録</h1>
    @if ($errors->any())
        <div class="error">
            <p>
                <b>{{ count($errors) }}件のエラーがあります。</b>
            </p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('customers.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name" class="fs-4">名前</label>
            <input class="form-control" type="text" name="name" value="{{ old('name') }}" maxlength="50" required
                autofocus>
        </div>
        <div class=" form-group">
            <label for="email" class="fs-4">メールアドレス</label>
            <input class="form-control" type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label for="zipcode" class="fs-4">郵便番号</label>
            <input class="form-control" type="text" name="zipcode" value="{{ old('zipcode', $zipcode) }}" maxlength="7"
                required>
        </div>
        <div class="form-group">
            <label for="address" class="fs-4">住所</label>
            <textarea class="form-control" name="address" cols="30" rows="10" maxlength="2000"
                required>{{ old('address', $address) }}</textarea>
        </div>
        <div class="form-group">
            <label for=" phone_number" class="fs-4">電話番号</label>
            <input class="form-control" type="text" name="phone_number" {{ old('phone_number') }}
                placeholder="電話番号(ハイフンあり)" required>
        </div>
        <input class="btn btn-success" type="submit" value="登録">
        <button class="btn btn-secondary" type="button"
            onclick="location=href='{{ route('customers.zipcode_search') }}'">郵便番号検索に戻る</button>
    </form>
@endsection
