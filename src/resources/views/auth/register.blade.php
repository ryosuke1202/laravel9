@extends('common.base')

@section('title', '新規登録')

@section('content')
<div class="py-6 sm:py-8 lg:py-12">
    <div class="max-w-screen-2xl px-4 md:px-8 mx-auto">
        <h2 class="text-gray-800 text-2xl lg:text-3xl font-bold text-center mb-4 md:mb-8">会員情報登録</h2>
        <form method="POST" action="{{ route('register') }}" class="max-w-2xl border rounded-lg mx-auto">
            @csrf
            <div class="bg-white flex flex-col gap-4 p-4 md:p-16">
                <div>
                    <label for="name" class="inline-block text-gray-800 text-sm sm:text-base mb-2">名前（フルネーム）</label>
                    <input name="name" id="name" placeholder="例)　田中太朗" value="{{ old('name') }}" class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2" required/>
                    @error('name')
                        <span class="text-red-700 font-mono">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="email" class="inline-block text-gray-800 text-sm sm:text-base mb-2">メールアドレス</label>
                    <input name="email" type="email" id="email" placeholder="例)　abc@autumn.jp" value="{{ old('email') }}" class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2" required/>
                    @error('email')
                        <span class="text-red-700 font-mono">{{ $message }}</span>
                    @enderror
                </div>

                <label for="phone_first" class="inline-block text-gray-800 text-sm sm:text-base">電話番号</label>
                <div class="flex">
                    <input id="phone_first" class="w-1/4 bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 mr-3" required/>_
                    <input id="phone_middle" class="w-1/4 bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 mr-3 ml-3" required/>_
                    <input id="phone_last" class="w-1/4 bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 ml-3" required/>
                    <input type="hidden" id="phone" name="phone">
                </div>
                @error('phone')
                    <span class="text-red-700 font-mono -mt-2">{{ $message }}</span>
                @enderror

                <div>
                    <label class="inline-block text-gray-800 text-sm sm:text-base mb-2">パスワード<small>（英数字のみで8文字以上）</small>　<i class="far fa-eye" id="passEye"></i></label>
                    <input name="password" type="password" id="password" placeholder="パスワードを入力してください" class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2" required/>
                    <input name="password_confirmation" type="password" id="password-confirm" placeholder="確認のためもう一度入力してください" class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 mt-4" required/>
                    @error('password')
                        <span class="text-red-700 font-mono">{{ $message }}</span>
                    @enderror
                </div>

                <label for="sex" class="inline-block text-gray-800 text-sm sm:text-base -mb-2">性別</label>
                <div class="flex">
                    <p class="mr-6"><input type="radio" name="sex" value="1" class="mr-2" id="man" @if(old('sex')==1) checked  @endif><label for="man">男性</label></p>
                    <p class="mr-6"><input type="radio" name="sex" value="2" class="mr-2"id="woman" @if(old('sex')==2) checked  @endif><label for="woman">女性</label></p>
                    <p><input type="radio" name="sex" value="3" class="mr-2" id="none" @if(old('sex')==3) checked  @endif><label for="none">設定なし</label></p>
                </div>
                <div class="-mt-5">
                    @error('sex')
                    <span class="text-red-700 font-mono">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="zip_code" class="inline-block text-gray-800 text-sm sm:text-base mb-2">郵便番号　<small><a href="https://www.post.japanpost.jp/zipcode" target="_blank" rel="noopener noreferrer" class="text-blue-700 underline">郵便番号をお忘れの方 （日本郵便）</a></small></label>
                    <input name="zip_code" type="text" id="zip_code" maxlength="7" onKeyUp="" placeholder="例)　9876543" value="{{ old('zip_code') }}" class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2" required/>
                    @error('zip_code')
                        <p><span class="text-red-700 font-mono" id="error_zip">{{ $message }}</span></p>
                    @enderror
                    @error('prefecture')
                        <p><span class="text-red-700 font-mono" id="error_prefecture">郵便番号に該当する住所情報が存在しません</span></p>
                    @enderror
                    <span class="text-red-700 font-mono" id="zip_code_message" style="display:none;">郵便番号に該当する住所情報が存在しません</span>
                    <p><small>※ハイフンを入れずに半角数字でご入力下さい</small></p>
                    <p><small>▼郵便番号を入力すると、住所の一部が自動的に表示されます</small></p>
                </div>

                <div>
                    <label for="prefecture" class="inline-block text-gray-800 text-sm sm:text-base mb-2">都道府県</label>
                    <input name="prefecture" type="text" id="prefecture" placeholder="例)　大阪府" readonly value="{{ old('prefecture') }}" class="w-full text-gray-800 transition duration-100 px-3 py-2" required/>
                </div>

                <div>
                    <label for="city" class="inline-block text-gray-800 text-sm sm:text-base mb-2">市区町村</label>
                    <input name="city" type="text" id="city" placeholder="例)　大阪市西淀川区" readonly value="{{ old('city') }}" class="w-full text-gray-800 transition duration-100 px-3 py-2" required/>
                </div>
                
                <div>
                    <label for="building" class="inline-block text-gray-800 text-sm sm:text-base mb-2">番地・マンション名</label>
                    <input name="building" type="text" id="building" placeholder="例)　4-5-6　●●マンション000号など" value="{{ old('building') }}" class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2" required/>
                    <p><small>※マンション名、部屋番号は短縮せずにご入力下さい</small></p>
                    @error('building')
                    <span class="text-red-700 font-mono">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="flex my-2">
                    <input type="checkbox" class="mt-1" required>　
                    <a href="#"  target="_blank" rel="noopener noreferrer" class="text-blue-700 underline">個人情報の取り扱いについて</a>
                    <p>　を確認しました</p>
                </div>

                <button type="submit" class="bg-gray-800 hover:bg-gray-700 active:bg-gray-600 focus-visible:ring ring-blue-300 text-white text-sm md:text-base font-semibold text-center rounded-lg outline-none transition duration-100 px-8 py-3">会員登録する</button>
            </div>
        </form>
    </div>
</div>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script> <!-- 住所自動入力 -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(function() {
    //パスワード表示非表示処理
    $('#passEye').click(function() {
        if ($(this).hasClass('fa-eye')) {
            $(this).removeClass('fa-eye').addClass('fa-eye-slash');
            $('#password').attr('type', 'text');
            $('#password-confirm').attr('type', 'text');
        } else {
            $(this).removeClass('fa-eye-slash').addClass('fa-eye');
            $('#password').attr('type', 'password');
            $('#password-confirm').attr('type', 'password');
        }
    });
    //住所自動入力処理
    $('#zip_code').keyup(function() {
        $('#prefecture').val('');
        $('#city').val('');
        //入力開始された時もしエラーメッセージがあったらエラーメッセージを消す
        $('#error_zip').css('display','none');
        $('#error_prefecture').css('display','none');
        $('#zip_code_message').css('display','none');
        //住所自動入力
        AjaxZip3.zip2addr(this,'','prefecture','city')
    });
    $('#zip_code').change(function() {
        if ($('#prefecture').val() === '') {//都道府県の欄が空欄だったらdisplay:noneを削除してエラーメッセージを表示
            $('#zip_code_message').css('display','');
        } else {//空欄じゃなかったらエラーメッセージを非表示にする
            $('#zip_code_message').css('display','none');
        }
        if ($(this).val() === '') {
            $('#zip_code_message').css('display','none');
        }
    });
    //電話番号を連結してhiddenで持たせる
    $('#phone_first').change(function() {
        let phone = $('#phone_first').val() + '-' + $('#phone_middle').val() + '-' + $('#phone_last').val();
        $('#phone').val(phone);
    });
    $('#phone_middle').change(function() {
        let phone = $('#phone_first').val() + '-' + $('#phone_middle').val() + '-' + $('#phone_last').val();
        $('#phone').val(phone);
    });
    $('#phone_last').change(function() {
        let phone = $('#phone_first').val() + '-' + $('#phone_middle').val() + '-' + $('#phone_last').val();
        $('#phone').val(phone);
    });
    //エラーがあった時old('phone')を代入
    if ('{{ old("phone") }}') {
        let phone_array = '{{ old("phone") }}'.split('-');
        $('#phone_first').val(phone_array[0]);
        $('#phone_middle').val(phone_array[1]);
        $('#phone_last').val(phone_array[2]);
    }

});
</script>
@endsection

