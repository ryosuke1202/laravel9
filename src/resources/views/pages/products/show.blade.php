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
                    <h2 class="text-gray-800 text-2xl lg:text-3xl font-bold text-center mb-4 md:mb-6">商品詳細</h2>
                </div>
                <div class="flex justify-around">
                    <div class="flex justify-center">
                        <img src="{{ asset('storage/images/' . $product->image) }}" alt="画像" style="width:400px; height:400px;">
                    </div>
                    <div class="flex items-center" style="width:400px; height:400px;">
                        <div>
                            <div class="flex justify-around mb-7">
                                <div class="text-center text-gray-800 font-bold text-2xl">{{ $product->name }}</div>
                                <div class="bg-pink-400 text-sm font-bold text-white rounded-lg px-2 py-1">{{ $product->type->name }}</div>
                                <div class="bg-pink-400 text-sm font-bold text-white rounded-lg px-2 py-1">{{ $product->tag->name }}</div>
                            </div>
                            <div class="text-gray-500 mb-7">{{ $product->description }}</div>
                            <div class="flex justify-around">
                                <div class="text-gray-800 font-bold text-2xl">￥{{ number_format($product->price) }}</div>
                                <div class="text-gray-800 font-bold text-2xl">在庫: {{ $product->stock }}個</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
