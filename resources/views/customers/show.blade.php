@extends('layouts.common')

@section('title', '顧客詳細')

@section('content')
    <h1 class="h2">顧客詳細</h1>
    <table class="table table-striped">
        <tr>
            <th>顧客ID</th>
            <th>名前</th>
            <th>メールアドレス</th>
            <th>郵便番号</th>
            <th>住所</th>
            <th>電話番号</th>
        </tr>
        <tr>
            <td>{{ $customer->id }}</td>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->zipcode }}</td>
            <td>{{ $customer->address }}</td>
            <td>{{ $customer->phone_number }}</td>
        </tr>
    </table>
    <div class="d-flex">
        <button type="button" class="btn btn-secondary"
            onclick="location=href='{{ route('customers.edit', $customer) }}'">編集画面</button>
        <form action="{{ route('customers.destroy', $customer) }}" method="post">
            @csrf
            @method('DELETE')
            <input class="btn btn-danger" type="submit" value="削除する" onclick="if(!confirm('削除しますか？')){return false};">
        </form>
        <button class="btn btn-light" type="button"
            onclick="location=href='{{ route('customers.index') }}'">一覧に戻る</button>
    </div>
@endsection
