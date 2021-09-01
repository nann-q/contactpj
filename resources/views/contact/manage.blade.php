@php
$title='管理システム';
@endphp

@extends('layout')

<link rel="stylesheet" href="{{asset('css/manage.css')}}">


@section('content')
  <div class="find">
    <h1 class="find-ttl">管理システム</h1>
    <form action="manage/search" method="post" class="find-content">
      @csrf
      <!-- お名前 -->
      <div class="find-fullname">
        <label class="find-form-label">お名前</label>
        <input type="text"
        class="find-form"
        name="fullname"
        >
      </div>
      <!-- 性別 -->
      <div class="find-gender">
        <label class="find-form-label">性別</label>
        <input type="radio"
        id="all"
        class="form-item-radio-0"
        name="gender"
        value="0"
        checked>
        <label for="all" class="form-gender-txt">全て</label>
        <input type="radio"
        id="male"
        class="form-item-radio-1"
        name="gender"
        value="1">
        <label for="male" class="form-gender-txt">男性</label>
        <input type="radio"
        id="female"
        class="form-item-radio-2"
        name="gender"
        value="2">
        <label for="female" class="form-gender-txt">女性</label>
      </div>
      <!-- 登録日 -->
      <div class="find-creaetd_at">
        <label class="find-form-label">登録日</label>
        <input type="date"
        class="find-form"
        name="from"
        >
        <span>~</span>
        <input type="date"
        class="find-form"
        name="until"
        >
      </div>
      <!-- メールアドレス -->
      <div class="find-email">
        <label class="find-form-label-email">メールアドレス</label>
        <input type="email"
        class="find-form"
        name="email"
        >
      </div>
      <!-- 検索、リセット -->
      <div class="find-button">
        <input type="submit" value="検索" class="submit-button">
        <a href="/contact/manage" class="reset-button">リセット</a>
      </div>
    </form>
  </div>
  <div class="result">
    <!--  ページネーション -->
    <div class="pagenation">
      @if (count($items)>0)
      <p class="pagenation-count">
        全{{$items->total()}}件中
        {{($items->currentPage()-1)*$items->perPage()+1}}~
        {{(($items->currentPage()-1)*$items->perPage()+1)+(count($items)-1)}}件</p>
      @else
      <p>データがありません。</p>
      @endif
      <p class="pagenation-page">
          {{ $items->appends(request()->input())->links('vendor.pagination.tailwind') }}
      </p>
    </div>
    <!-- 検索結果 -->
    <div class="result-content">
      @if(@isset($items))
      <table>
        <tr>
          <th class="result-item">ID</th>
          <th class="result-item">お名前</th>
          <th class="result-item">性別</th>
          <th class="result-item">メールアドレス</th>
          <th class="result-item">ご意見</th>
          <th class="result-item"></th>
        </tr>
        @foreach($items as $item)
        <tr>
          <td class="result-item-content">
            {{$item->id}}
          </td>
          <td class="result-item-content">
            {{$item->fullname}}
          </td>
          <td class="result-item-content">
            @php
            if($item->gender == 1){
            print '男性';
            }else{
              print'女性';
            }
            @endphp
          </td>
          <td class="result-item-content">
            {{$item->email}}
          </td>
          <td class="result-item-content">
            <span class="hidden">
              {{Str::limit($item->opinion,50)}}
            </span>
            <span class="open">
              {{$item->opinion}}
            </span>
          </td>
          <td>
            <form action="{{ route('manage.delete',['id'=>$item->id]) }} " method="POST">
              @csrf
              <button class="result-item-delete">削除</button>
            </form>
          </td>
        </tr>
        @endforeach
      </table>
      @endif
    </div>
  </div>
@endsection
