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
            <div class="py-16">
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 p-0 overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal"></th>
                                    <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                        注文番号
                                    </th>
                                    <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                        日付
                                    </th>
                                    <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                        顧客名
                                    </th>
                                    <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                        ステータス
                                    </th>
                                    <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                        合計金額
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
                                                    <a href="{{ route('carts.show', ['cart' => $cart->order_number]) }}" class="block relative text-blue-400">
                                                        {{ $cart->order_number }}
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $cart->created_at }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $cart->users->name }}
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
                                        </tr>
                                    @endforeach
                                </form>
                            </tbody>
                        </table>
                        <div class="absolute m-5 ml-36">
                            <button type="button" id="changeStatus" class="flex shadow w-32 block border-gray-400 border-2 rounded-full px-4 py-2 text-gray-400 hover:bg-gray-200 hover:text-white">
                                <span class="m-auto">送信済み</span>
                            </button>
                        </div>
                        @include('pagination.paginate')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ mix('js/app.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    let backFlg = sessionStorage.getItem('backFlg');
    if (backFlg != 1) {
        sessionStorage.clear();
    }
    // 検索エンジンに値が入力されており、虫眼鏡ボタンを押下した際、詳細画面に遷移
    $('.rnd-button').on('click', function () {
        if (sessionStorage.getItem('orderNum')) {
            window.location.href = 'http://localhost/carts/' + sessionStorage.getItem('orderNum');
        }
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
                    // 'cart': cartsStatusVal,
                    'request': cartsStatusVal[0],
                    _token:     '{{ csrf_token() }}'
                },
            })
            .done(function (res) {
                let changeStatus = $('#' + res.id);
                changeStatus.children().remove();
                changeStatus.append(
                    '<span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"><span aria-hidden="true" class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span><span class="relative">発送済み</span></span>'
                );
            })
            .fail(function (e) {
                console.log(e);
            });
        }
    });
</script>
@endsection
