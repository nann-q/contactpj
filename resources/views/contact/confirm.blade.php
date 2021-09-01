@php
$title='内容確認';
@endphp

@extends('layout')

<link rel="stylesheet" href="{{asset('css/index.css')}}">

@section('content')
  <h1 class="content-ttl">内容確認</h1>
    <form action="{{ route('process') }}"
    class="form" method="post">
    @csrf
    <table>
      <!-- お名前 -->
      <tr>
        <th class="form-item">お名前</th>
        <td class="form-item-inputs">
          {{ $inputs['lastname']}} {{ $inputs['firstname'] }}
        </td>
      </tr>
      <input type="hidden"
      name="lastname"
      value="{{ $inputs['lastname'] }}">
      <input type="hidden"
      name="firstname"
      value="{{ $inputs['firstname'] }}">
      <input type="hidden"
      name="fullname"
      value="{{ $inputs['lastname'] }}{{ $inputs['firstname'] }}">

      <!-- 性別 -->
      <tr>
        <th class="form-item">性別</th>
        <td class="form-item-inputs">
          @php
          if($inputs['gender'] == 1){
          print '男性';
          }else{
            print'女性';
          }
          @endphp
        </td>
      </tr>
      <input type="hidden"
      name="gender"
      value="{{ $inputs['gender'] }}">

      <!-- メールアドレス -->
      <tr>
        <th class="form-item">メールアドレス</th>
        <td class="form-item-inputs">{{ $inputs['email'] }}</td>
      </tr>
      <input type="hidden"
      name="email"
      value="{{ $inputs['email'] }}">

      <!-- 郵便番号 -->
      <tr>
        <th class="form-item">郵便番号</th>
        <td class="form-item-inputs">{{ $inputs['postcode'] }}</td>
      </tr>
      <input type="hidden"
      name="postcode"
      value="{{ $inputs['postcode'] }}">

      <!-- 住所 -->
      <tr>
        <th class="form-item">住所</th>
        <td class="form-item-inputs">{{ $inputs['address'] }}</td>
      </tr>
      <input type="hidden"
      name="address"
      value="{{ $inputs['address'] }}">

      <!-- 建物名 -->
      <tr>
        <th class="form-item">建物名</th>
        <td class="form-item-inputs">{{ $inputs['building_name'] }}</td>
      </tr>
      <input type="hidden"
      name="building_name"
      value="{{ $inputs['building_name'] }}">

      <!-- ご意見 -->
      <tr>
        <th class="form-item">ご意見</th>
        <td class="form-item-inputs">{{ $inputs['opinion'] }}</td>
      </tr>
      <input type="hidden"
      name="opinion"
      value="{{ $inputs['opinion'] }}">
    </table>

      <!-- 送信 -->
      <button
      type="submit"
      value="submit"
      name="action"
      class="submit-button"
      >
        送信
      </button>
      <br>
      <!-- 修正 -->
      <button
      type="submit"
      value="return"
      name="action"
      class="reset-button"
      >
      修正する
    </button>
    </form>

@endsection












