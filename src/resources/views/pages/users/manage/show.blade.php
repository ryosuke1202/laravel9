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
                @if(session('message'))
                    <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                        <p class="font-bold text-center">{{ session('message') }}</p>
                    </div>
                @endif
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 p-0 overflow-x-auto mt-5">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <div class="balloon1">
                            <p>受注情報</p>
                        </div>
                        <table class="leading-normal" style="width: 90%; margin: 0px auto 30px;">
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
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center">
                                        <p class="text-gray-900 whitespace-no-wrap text-center">
                                            {{ $user->id }}
                                        </p>
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
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center">
                                        @if ($user->status === '制限なし')
                                            <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                <span aria-hidden="true" class="absolute inset-0 bg-green-200 opacity-50 rounded-full">
                                                </span>
                                                <span class="relative">
                                                    {{ $user->status }}
                                                </span>
                                            </span>
                                        @else
                                            <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                                <span aria-hidden="true" class="absolute inset-0 bg-red-400 opacity-50 rounded-full">
                                                </span>
                                                <span class="relative">
                                                    {{ $user->status }}
                                                </span>
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $user->role_id }}
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="balloon1">
                            <p>詳細情報</p>
                        </div>
                        <table class="leading-normal" style="width: 90%; margin: 0px auto 30px;">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal text-center">
                                        電話番号
                                    </th>
                                    <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal text-center">
                                        郵便番号
                                    </th>
                                    <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal text-center">
                                        住所
                                    </th>
                                    <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal text-center">
                                        登録日
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $user->phone }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap text-center">
                                            {{ substr($user->zip_code, 0, 3) }} - {{ substr($user->zip_code, 3) }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $user->prefecture . $user->city . $user->building }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $user->created_at }}
                                        </p>
                                    </td>
                                    {{-- <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $user->email }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center">
                                        @if ($user->status === '制限なし')
                                            <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                <span aria-hidden="true" class="absolute inset-0 bg-green-200 opacity-50 rounded-full">
                                                </span>
                                                <span class="relative">
                                                    {{ $user->status }}
                                                </span>
                                            </span>
                                        @else
                                            <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                                <span aria-hidden="true" class="absolute inset-0 bg-red-400 opacity-50 rounded-full">
                                                </span>
                                                <span class="relative">
                                                    {{ $user->status }}
                                                </span>
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $user->role_id }}
                                        </p>
                                    </td> --}}
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
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
