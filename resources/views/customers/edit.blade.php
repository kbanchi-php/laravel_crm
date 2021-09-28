@extends('layouts.common')

@section('title', '編集画面')

@section('content')
    <h1 class="h2">編集画面</h1>
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
    <form action="{{ route('customers.update', $customer) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="name" class="fs-4">名前</label>
            <input class="form-control" type="text" name="name" value="{{ old('name', $customer->name) }}" maxlength="50"
                required autofocus>
        </div>
        <div class="form-group">
            <label for="email" class="fs-4">メールアドレス</label>
            <input class="form-control" ype="email" name="email" value="{{ old('email', $customer->email) }}" required>
        </div>
        <div class="form-group">
            <label for="zipcode" class="fs-4">郵便番号</label>
            <input class="form-control" type="text" name="zipcode" value="{{ old('zipcode', $customer->zipcode) }}"
                maxlength="7" required>
        </div>
        <div class="form-group">
            <label for="address" class="fs-4">住所</label>
            <textarea class="form-control" name="address" cols="30" rows="10" maxlength="2000"
                required>{{ old('address', $customer->address) }}</textarea>
        </div>
        <div class="form-group">
            <label for=" phone_number">電話番号</label>
            <input class="form-control" type="text" name="phone_number"
                value="{{ old('phone_number', $customer->phone_number) }}" placeholder="電話番号(ハイフンあり)" required>
        </div>
        <input class="btn btn-primary" type="submit" value="更新">
        <button class="btn btn-light" type="button"
            onclick="location=href='{{ route('customers.show', $customer) }}'">戻る</button>
    </form>
@endsection
