@php
$title='お問い合わせ';
@endphp

@extends('layout')

<link rel="stylesheet" href="{{asset('css/index.css')}}">

@section('content')
  <h1 class="content-ttl">お問い合わせ</h1>
    <form action="/contact/confirm"
    class="form"
    method="post"
    id="form">
    @csrf
      <!-- 名前 -->
      <table>
        <tr>
          <th class="form-item">お名前
          <span class="form-item-required"> ※</span>
          </th>
          <td>
            <input type="text"
            name="lastname"
            id="lastname"
            class="form-item-input-half"
            value="{{old('lastname')}}"
            >
            <input type="text"
            name="firstname"
            id="firstname"
            class="form-item-input-half"
            value="{{old('firstname')}}"
            >
          </td>
        </tr>
        <tr>
          <th></th>
          <td>
            <span class="form-item-example">　例）山田</span>
            <span class="form-item-example">　例）太郎</span>
          </td>
        </tr>
      </table>
      <div class="error">
        @error('lastname')
        <p class="form-error-fullname"
        >{{$message}}</p>
        @enderror('lastname')
        @error('firstname')
        <p class="form-error-fullname"
        >{{$message}}</p>
        @enderror

        <p class="form-error-fullname"
        id="form-error-lastname">
        名字は必須です。</p>
        <p class="form-error-fullname"
        id="form-error-firstname">
        名前は必須です。</p>

      </div>
      </table>
      <!-- 性別 -->
      <table>
        <tr>
          <th class="form-item">性別<span class="form-item-required"> ※</span>
          </th>
          <td>
            <label class="form-gender">
              <input type="radio"
              name="gender"
              id="male"
              value='1' {{ old('gender')=='1'?'checked':'' }}
              checked="checked" class="form-item-radio-1">
              <label for="male"
              class="form-gender-txt">男性</span>
            </label>
            <label class="form-gender">
              <input type="radio"
              name="gender"
              id="female"
              value="2" {{ old('gender')=='2'?'checked':'' }}
              class="form-item-radio-2">
              <label
              for="female"
              class="form-gender-txt">女性</span>
            </label>
          </td>
        </tr>
      </table>
      <!-- メールアドレス -->
      <table>
        <tr>
          <th class="form-item">メールアドレス<span class="form-item-required"> ※</span>
          </th>
          <td>
            <input type="email"
            name="email"
            id="email"
            class="form-item-input"
            value="{{old('email')}}">
          </td>
        </tr>
        <tr>
          <th></th>
          <td class="form-item-example">　例）test@example.com</td>
        </tr>
        @error('email')
        <tr>
          <th></th>
          <td class="form-error" id="form-error-email">{{$message}}</td>
        </tr>
        @enderror
      </table>
      <div class="error">
        <p class="form-error-hidden" id="form-error-email">メールアドレスは必須です。</p>
      </div>
      <!-- 郵便番号 -->
      <table>
        <tr>
          <th class="form-item">郵便番号<span class="form-item-required" > ※</span></label>
          </th>
          <td>
            <span>〒</span>
            <input type="text"
            name="postcode"
            id="postcode"
            onblur="toHalfWidth(this)"
            onKeyUp="AjaxZip3.zip2addr(this,'','address','address');" class="form-item-input"
            value="{{old('postcode')}}"
            id="postcode"
            >
          </td>
        </tr>
        <tr>
          <th></th>
          <td class="form-item-example">　例）123-4567</td>
        </tr>
        @error('postcode')
        <tr>
          <th></th>
          <td class="form-error" id="form-error-postcode">{{$message}}</td>
        </tr>
        @enderror
      </table>
      <div class="error">
        <p class="form-error-hidden" id="form-error-postcode">郵便番号は必須です。</p>
      </div>
      <!-- 住所 -->
      <table>
        <tr>
          <th class="form-item">住所<span class="form-item-required" > ※</span></label>
          </th>
          <td>
            <input type="text"
            name="address"
            id="address"
            class="form-item-input"
            value="{{old('address')}}">
          </td>
        </tr>
        <tr>
          <th></th>
          <td class="form-item-example">　例）東京都渋谷区千駄ヶ谷1-2-3</td>
        </tr>
        @error('address')
        <tr>
          <th></th>
          <td class="form-error" id="form-error-address">{{$message}}</td>
        </tr>
        @enderror
      </table>
      <div class="error">
        <p class="form-error-hidden" id="form-error-address">住所は必須です。</p>
      </div>
      <!-- 建物名 -->
        <table>
        <tr>
          <th class="form-item">建物名</label>
          </th>
          <td>
            <input type="text" name="building_name" class="form-item-input"
            value="{{old('building_name')}}">
          </td>
        </tr>
        <tr>
          <th></th>
          <td class="form-item-example">　例）千駄ヶ谷マンション101</td>
        </tr>
      </table>
      <!-- ご意見 -->
      <table>
        <tr>
          <th class="form-item">ご意見<span class="form-item-required" > ※</span></label>
          </th>
          <td>
            <textarea
            name="opinion"
            id="opinion"
            class="form-item-textarea"
            required>
              {{old('opinion')}}
          </textarea>
          </td>
        </tr>
        @error('opinion')
        <tr>
          <th></th>
          <td class="form-error" id="form-error-opinion">{{$message}}</td>
        </tr>
        @enderror
      </table>
      <div class="error">
        <p class="form-error-hidden" id="form-error-opinion">ご意見は必須です。</p>
      </div>
      <!-- 確認 -->
      <button type="submit"
      id="submit"
      class="submit-button">確認</button>
    </form>
<script>
//form
const form = document.getElementById("form");

//form element
const lastname = document.getElementById("lastname");
const fitstname = document.getElementById("firstname");
const email = document.getElementById("email");
const postcode = document.getElementById("postcode");
const address = document.getElementById("address");
const opinion = document.getElementById("opinion");

//error message
const form_error_lastname = document.getElementById("form-error-lastname")
const form_error_firstname = document.getElementById("form-error-firstname")
const form_error_email = document.getElementById("form-error-email")
const form_error_postcode = document.getElementById("form-error-postcode")
const form_error_address = document.getElementById("form-error-address")
const form_error_opinion = document.getElementById("form-error-opinion")


//バリデーションパターン
const nameExp = /^[ぁ-んーァ-ンヴー亜-黑]{1,}$/;
const emailExp=/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)*$/;
const postcodeExp=/^\d{3}-\d{4}$/;
const addressExp=/^[ぁ-んーァ-ンヴー亜-黑0-9!-/:-@¥[-`{-~]{1,}$/;
const opinionExp=/^[ぁ-んーァ-ンヴー亜-黑]{1,120}$/;


//lastname
    lastname.addEventListener("keyup", e => {
      if (nameExp.test(lastname.value)) {
        form_error_lastname.style.display = "none";
      } else {
        form_error_lastname.style.display = "inline";
      }
    })
//firstname
    firstname.addEventListener("keyup", e => {
      if (nameExp.test(firstname.value)) {
        form_error_firstname.style.display = "none";
      } else {
        form_error_firstname.style.display = "inline";
      }
    })
//email
    email.addEventListener("keyup", e => {
      if (emailExp.test(email.value)) {
        form_error_email.style.display = "none";
      } else {
        form_error_email.style.display = "inline";
      }
    })
// postcode
    postcode.addEventListener("keyup", e => {
      if (postcodeExp.test(postcode.value)) {
        form_error_postcode.style.display = "none";
      } else {
        form_error_postcode.style.display = "inline";
      }
    })
// address
    address.addEventListener("keyup", e => {
      if (addressExp.test(address.value)) {
        form_error_address.style.display = "none";
      } else {
        form_error_address.style.display = "inline";
      }
    })
// opinion
    opinion.addEventListener("keyup", e => {
      if (opinionExp.test(opinion.value)) {
        form_error_opinion.style.display = "none";
      } else {
        form_error_opinion.style.display = "inline";
      }
    })
// 全角→半角
function toHalfWidth(elm) {
    elm.value = elm.value.replace(/[Ａ-Ｚａ-ｚ０-９－！”＃＄％＆’（）＝＜＞，．？＿［］｛｝＠＾～￥]/g,
    function(s){
        return String.fromCharCode(s.charCodeAt(0)-0xFEE0);
    });
}
</script>
@endsection






