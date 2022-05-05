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
            <div class="py-16 pt-10">
                {{-- <div class="mb-10 md:mb-16">
                    <h2 class="text-gray-800 text-2xl lg:text-3xl font-bold text-center mb-4 md:mb-6">顧客管理</h2>
                </div> --}}
                @if(session('message'))
                    <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                        <p class="font-bold text-center">{{ session('message') }}</p>
                    </div>
                @endif
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 p-0 overflow-x-auto mt-5">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal text-center">
                                        id
                                    </th>
                                    <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal text-center">
                                        名前
                                    </th>
                                    <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal text-center">
                                        性別
                                    </th>
                                    <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal text-center">
                                        メールアドレス
                                    </th>
                                    <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal text-center">
                                        ステータス
                                    </th>
                                    <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal text-center">
                                        権限
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-center">
                                            <a href="{{ route('users.manage.show', ['id' => $user->id]) }}" class="whitespace-no-wrap text-center text-blue-400">
                                                {{ $user->id }}
                                            </a>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap text-center">
                                                {{ $user->name }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $user->sex }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $user->email }}
                                            </p>
                                        </td>
                                        @if ($user->status === '制限なし')
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                    <span aria-hidden="true" class="absolute inset-0 bg-green-200 opacity-50 rounded-full">
                                                    </span>
                                                    <span class="relative">
                                                        {{ $user->status }}
                                                    </span>
                                                </span>
                                            </td>
                                        @else
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                                    <span aria-hidden="true" class="absolute inset-0 bg-red-400 opacity-50 rounded-full">
                                                    </span>
                                                    <span class="relative">
                                                        {{ $user->status }}
                                                    </span>
                                                </span>
                                            </td>
                                        @endif
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $user->role_id }}
                                            </p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- モーダルウィンドウ -->
                        <modal
                            url="{{ route('users.manageCsv') }}"
                        >
                        </modal>
                        <!-- モーダルウィンドウ -->
                        @include('pagination.paginateUser')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ mix('js/app.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $('#logicDelete').on('click', function () {
        const user = $('#logicDelete');
        console.log($('input[name=user]').val());
        // console.log(user.attributes.userId);
        // console.log(typeof(user.attributes.userId));
        // $.ajax({
        //     type: 'POST',
        //     datatype:'json',
        //     url: "/domain/controller/changePaginate",
        //     data: {
        //         data: data,
        //         userid: userid,
        //         _csrfToken: _csrfToken
        //     },
        //     beforeSend: function(xhr){
        //         xhr.setRequestHeader("X-CSRF-Token",_csrfToken);
        //     },
        // })
        // .done((data, textStatus, jqXHR) => {
        //     doReload(); // 通信成功したときにリロードさせることで反映させる
        //     console.log('通信成功');
        // })
        // .fail((jqXHR, textStatus, errorThrown) => {
        //     console.log('通信失敗');
        // });
        // return false;
    });
</script>
