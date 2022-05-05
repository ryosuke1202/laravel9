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
                    <h2 class="text-gray-800 text-2xl lg:text-3xl font-bold text-center mb-4 md:mb-6">{{ $title }}</h2>
                </div>
                @if(session('message'))
                    <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                        <p class="font-bold text-center">{{ session('message') }}</p>
                    </div>
                @endif
                <div class="bg-white py-6 sm:py-8 lg:py-12 mt-8">
                    <div class="max-w-screen-2xl px-4 md:px-8 mx-auto">
                            @if ($errors->any())
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative max-w-screen-md grid sm:grid-cols-2 gap-4 mx-auto mb-10" role="alert">
                                    @foreach($errors->all() as $error)
                                        <span class="block sm:inline">{{ $error }}</span>
                                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                            <form action="{{ $product->id ? Route('products.update', $product) : Route('products.store') }}" method="post" name="ansform" enctype="multipart/form-data" class="max-w-screen-md grid sm:grid-cols-2 gap-4 mx-auto">
                                @csrf
                                <div class="sm:col-span-2">
                                    <label for="name" class="inline-block text-gray-800 text-sm sm:text-base mb-2">商品名</label>
                                    <input type="text" name="name" id="name" value="{{ $product->id ? $product->name : old('name') }}" class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2"/>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="image" class="inline-block text-gray-800 text-sm sm:text-base mb-2">画像</label>
                                    <input id="image" type="file" name="image" class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2">
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="tag_id" class="inline-block text-gray-800 text-sm sm:text-base mb-2">製品タグ</label>
                                    <select name="tag_id" id="tag_id" class="block appearance-none w-full bg-gray-50 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                                        <option value="" selected></option>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}" @if($product->tag_id==$tag->id||old('tag_id')==$tag->id) selected  @endif>{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="type_id" class="inline-block text-gray-800 text-sm sm:text-base mb-2">製品タイプ</label>
                                    <select name="type_id" id="type_id" class="block appearance-none w-full bg-gray-50 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                                        <option value="" selected></option>
                                        @foreach($types as $type)
                                            <option value="{{ $type->id }}" @if($product->type_id==$type->id||old('type_id')==$type->id) selected  @endif>{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="price" class="inline-block text-gray-800 text-sm sm:text-base mb-2">値段</label>
                                    <input type="number" name="price" id="price" value="{{ $product->id ? $product->price : old('price') }}" class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2"/>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="stock" class="inline-block text-gray-800 text-sm sm:text-base mb-2">在庫数</label>
                                    <input type="number" name="stock" id="stock" value="{{ $product->id ? $product->stock : old('stock') }}" class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2"/>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="description" class="inline-block text-gray-800 text-sm sm:text-base mb-2">商品説明</label>
                                    <textarea name="description" id="description" class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2">{{ $product->id ? $product->description : old('description') }}</textarea>
                                </div>

                                <div class="sm:col-span-2 flex justify-around items-center mt-40">
                                    <a href="{{ Route('products.manageIndex') }}" class="inline-block bg-gray-400 hover:bg-gray-500 active:bg-gray-600 focus-visible:ring ring-indigo-300 text-white text-sm md:text-base font-semibold text-center rounded-lg outline-none transition duration-100 px-8 py-3">キャンセル</a>
                                    <input type="submit" value="{{ $submit }}" class="inline-block bg-blue-400 hover:bg-blue-500 active:bg-blue-600 focus-visible:ring ring-indigo-300 text-white text-sm md:text-base font-semibold text-center rounded-lg outline-none transition duration-100 px-8 py-3"/>
                                </div>
                                @if ($product->id)
                                    <input type="hidden" name="_method" value="PUT">
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
