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
                @if(session('message'))
                    <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                        <p class="font-bold text-center">{{ session('message') }}</p>
                    </div>
                @endif
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 p-0 overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <table class="min-w-full leading-normal">
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
                                    <!-- <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                        
                                    </th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @csrf
                                <form action="" name="cartsStatus">
                                    @foreach ($users as $user)
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
                                                    {{ $user->zip_code }}
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $user->prefecture . $user->city . $user->building }}
                                                </p>
                                            </td>
                                            <!-- <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    <form method="post" action="{{ Route('users.delete', $user) }}">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="inline-block bg-red-300 hover:bg-red-400 active:bg-red-500 focus-visible:ring ring-indigo-300 text-white text-sm md:text-base font-semibold text-center rounded-lg outline-none transition duration-100 px-8 py-3" onClick="return confirm('本当に削除しますか？');">削除</button>
                                                    </form>
                                                </p>
                                            </td> -->
                                        </tr>
                                    @endforeach
                                </form>
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
@endsection
