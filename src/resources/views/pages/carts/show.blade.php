@extends('common.management.managementBase')
@section('title')
    管理者用ページ
@endsection
@section('content')
<div id="app" class="min-h-screen" style="background-color: #FDF6F6;">
    <div class="relative" style="height: 4.3rem">
        @include('common.management.manegementheader')
    </div>
    <div class="flex">
        @include('common.management.managementNav')
        <div class="container mx-auto px-4 sm:px-8 w-full h-full">
            <div style="padding-top: 2rem;padding-bottom: 2rem;">
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 p-0 overflow-x-auto">
                    <div class="flex inline-block min-w-full rounded-lg overflow-hidden">
                        <div class="min-w-full" style="">
                            <div class="balloon1">
                                <p>受注情報</p>
                            </div>
                            <table class="leading-normal" style="width: 90%;margin:0 auto;margin-bottom: 30px;">
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal"></th>
                                        <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                            注文番号
                                        </th>
                                        <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                            購入日
                                        </th>
                                        <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                            ステータス
                                        </th>
                                        <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                            合計金額
                                        </th>
                                        <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                            ステータス変更
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @csrf
                                    <form action="" name="cartsStatus">
                                        @foreach ($carts as $cart)
                                            <tr>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <input type="checkbox" name="send" value="{{ $cart->id }}" />
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <div class="flex-shrink-0">
                                                        {{ $cart->order_number }}
                                                    </div>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ $cart->created_at }}
                                                    </p>
                                                </td>
                                                @if ($cart->statuses->name == '発送済み')
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                        <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                            <span aria-hidden="true" class="absolute inset-0 bg-green-200 opacity-50 rounded-full">
                                                            </span>
                                                            <span class="relative">
                                                                {{ $cart->statuses->name }}
                                                            </span>
                                                        </span>
                                                    </td>
                                                @elseif ($cart->statuses->name == '削除')
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                        <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                                            <span aria-hidden="true" class="absolute inset-0 bg-red-400 opacity-50 rounded-full">
                                                            </span>
                                                            <span class="relative">
                                                                {{ $cart->statuses->name }}
                                                            </span>
                                                        </span>
                                                    </td>
                                                @else
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm" id="{{ $cart->id }}">
                                                        <span class="relative inline-block px-3 py-1 font-semibold text-pink-900 leading-tight">
                                                            <span aria-hidden="true" class="absolute inset-0 bg-pink-400 opacity-50 rounded-full">
                                                            </span>
                                                            <span class="relative">
                                                                {{ $cart->statuses->name }}
                                                            </span>
                                                        </span>
                                                    </td>
                                                @endif
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ '¥' . number_format($cart->totalFee->total_fee) }}
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <button id="changeStatus" class="flex shadow w-24 block border-gray-400 border-2 rounded-full px-4 py-2 text-gray-400 hover:bg-red-200 hover:text-white">
                                                        送信済み
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </form>
                                </tbody>
                            </table>
                            <div class="balloon1">
                                <p>ユーザー情報</p>
                            </div>
                            <table class="leading-normal" style="width: 90%;margin:0 auto;">
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                            ユーザーID
                                        </th>
                                        <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                            顧客名
                                        </th>
                                        <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                            性別
                                        </th>
                                        <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                            郵便番号
                                        </th>
                                        <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                            住所
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $user->id }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $user->name }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                @if ($user->sex === 1)
                                                    男性
                                                @else
                                                    女性
                                                @endif
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <div class="flex-shrink-0">
                                                {{ $zipCode }}
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $user->prefecture . $user->city . $user->building }}
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            @foreach ($carts as $cart)
                                <div class="balloon1">
                                    <p>商品一覧</p>
                                </div>
                                <table class="leading-normal" style="width: 90%;margin:0 auto;">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                                商品ID
                                            </th>
                                            <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                                商品名
                                            </th>
                                            <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                                注文数
                                            </th>
                                            <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                                タイプ
                                            </th>
                                            <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                                タグ
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $cart->products->id }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $cart->products->name }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $cart->quantity }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <div class="flex-shrink-0">
                                                    {{ $cart->types->name }}
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $cart->tags->name }}
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $cart->products->id }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $cart->products->name }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $cart->quantity }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <div class="flex-shrink-0">
                                                    {{ $cart->types->name }}
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $cart->tags->name }}
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $cart->products->id }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $cart->products->name }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $cart->quantity }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <div class="flex-shrink-0">
                                                    {{ $cart->types->name }}
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $cart->tags->name }}
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    img {
        vertical-align: bottom;
    }

    .balloon1 {
        position: relative;
        display: inline-block;
        margin: 1.5em 0;
        padding: 7px 10px;
        min-width: 120px;
        max-width: 100%;
        color: #555;
        font-size: 16px;
        background: #EDB661;
        text-align: center;
        left: 60px;
    }

    .balloon1:before {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -15px;
        border: 15px solid transparent;
        border-top: 15px solid #EDB661;
    }

    .balloon1 p {
        margin: 0;
        padding: 0;
    }
</style>

<script src="{{ mix('js/app.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    // 検索エンジンにあるボタンを推した際に、検索できる
    $('#send').on('click', function () {
        console.log('arigatou');
    });
    // ステータスを変更する商品番号を格納する配列
    let cartsStatusVal = '';
    let ensureCheckBox = [];

    // 選択したチェックボックスの商品番号を取得後に非同期でサーバーに送り、ビューのステータスを変更させる。
    $('#changeStatus').on('click', function () {
        // ステータス変更して良いか確認する。
        if (!confirm('ステータスを発送済みに変更しますか。')) return;

        cartsStatusVal = [];

        // 複数チェックされているか確認するための変数に、チェックされたカート情報を代入
        $(':checkbox[name="send"]:checked').each(function () {
            cartsStatusVal.push($(':checkbox[name="send"]:checked').val());
        });

        // 複数チェックされた場合、アラートを出力
        if (cartsStatusVal.length > 1) {
            alert('複数選択されているため、更新できません。');
        // 1つもチェックしていない場合、アラートを出力
        } else if (cartsStatusVal.length == 0) {
            alert('更新する情報をチェックしてください。');
        } else {
            // 非同期通信を行い、ステータスの変更を実施
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
                method: 'put',
                url: '/carts/' + cartsStatusVal[0],
                dataType: 'JSON',
                data: {
                    'request': cartsStatusVal[0],
                    _token:     '{{ csrf_token() }}'
                },
            })
            .done(function (res) {
                console.log('OK');
                let changeStatus = $('#' + res.id);
                console.log(changeStatus);
                changeStatus.children().remove();
                changeStatus.append(
                    '<span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"><span aria-hidden="true" class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span><span class="relative">発送済み</span></span>'
                );
            })
            .fail(function (e) {
                console.log('fail');
                console.log(e);
            });
        }
    });
</script>
@endsection
