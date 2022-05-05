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
                <div class="mb-10 md:mb-16">
                    <h2 class="text-gray-800 text-2xl lg:text-3xl font-bold text-center mb-4 md:mb-6">ブログ管理</h2>
                </div>
                @if(session('message'))
                    <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                        <p class="font-bold text-center">{{ session('message') }}</p>
                    </div>
                @endif
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 p-0 overflow-x-auto mt-5">
                    <button onclick="location.href='{{ Route('blogs.create') }}'" style="margin-left:900px;" class="ml-160 inline-block bg-blue-400 hover:bg-blue-500 active:bg-blue-600 focus-visible:ring ring-indigo-300 text-white text-sm md:text-base font-semibold text-center rounded-lg outline-none transition duration-100 px-8 py-3 mb-7">
                        新規ブログ投稿
                    </button>
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal text-center">
                                        タイトル
                                    </th>
                                    <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal text-center">
                                        商品名
                                    </th>
                                    <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal text-center">
                                        投稿日
                                    </th>
                                    <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal text-center">
                                        編集
                                    </th>
                                    <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal text-center">
                                        削除
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blogs as $blog)
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <div class="flex-shrink-0">
                                                <a href="#" class="block relative text-blue-400 text-center text-xl">
                                                    {{ $blog->title }}
                                                </a>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $blog->product->name }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $blog->created_at->format('Y-m-d') }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                <button onclick="location.href='{{ Route('blogs.edit', $blog) }}'" class="inline-block bg-gray-400 hover:bg-gray-500 active:bg-gray-600 focus-visible:ring ring-indigo-300 text-white text-sm md:text-base font-semibold text-center rounded-lg outline-none transition duration-100 px-8 py-3">編集</button>
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                            <form method="post" action="{{ Route('blogs.destroy', $blog) }}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="inline-block bg-red-300 hover:bg-red-400 active:bg-red-500 focus-visible:ring ring-indigo-300 text-white text-sm md:text-base font-semibold text-center rounded-lg outline-none transition duration-100 px-8 py-3" onClick="return confirm('本当に削除しますか？');">削除</button>
                                            </form>
                                            </p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @include('pagination.paginateBlog')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
