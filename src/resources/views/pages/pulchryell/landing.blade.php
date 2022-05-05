@extends('common.base')

@section('title', 'トップページ')

@section('content')
<div class="relative z-0">
    <img src="assets/images/pulchryel.jpeg" alt="pulchryelのメイン画像" class="w-full mt-10 relative inset-0">
    <a href="#"><img src="assets/images/instagram.png" alt="instagramのリンク画像" class="w-5 h-5 absolute top-12 right-3"></a>
    <a href="#"><img src="assets/images/youtube.png" alt="youtubeのリンク画像" class="w-5 h-5 absolute top-20 right-3"></a>
    <a href="#"><img src="assets/images/twitter.png" alt="twitterのリンク画像" class="w-5 h-5 absolute top-28 right-3"></a>
</div>

<section class="py-14 px-8">
    <h1 class="bg-black w-60 text-white text-center py-2.5 mx-auto">Products</h1>
    <ul class="flex flex-wrap items-center justify-center mt-9">
        @foreach($products as $product)
        <li class="w-2/6">
            <img src="{{ asset('storage/images/' . $product->image) }}" alt="商品画像" class="w-28 h-28 mx-auto">
            <div class="flex items-center justify-center mt-2">
                <p class="text-xs">{{ $product->name }}</p>
                <i class="fas fa-heart fa-xs text-gray-600 ml-2"></i>
            </div>
        </li>
        @endforeach
    </ul>
    <div class="text-right mt-4 text-sm">
        <p class="pb-0.5 border-b-2 border-black inline-block">商品一覧へ</p>
    </div>
</section>

<section class="bg-white py-14 px-6">
    <h1 class="bg-black w-60 text-white text-center py-2.5 mx-auto">Blog</h1>
    <ul class="flex flex-wrap items-center justify-center mt-7">
        @foreach($blogs as $blog)
        <li class="w-2/6">
            <img src="" alt="" class="w-28 h-28 mx-auto border-t border-r border-l border-black">
            <div class="w-28 mx-auto border-l border-r border-b border-black py-2 px-1">
                <h1 class="text-center">{{ $blog->title }}</h1>
                <p class="w-28">test</p>
                <a href="#" class="text-center inline-block text-xs"> 詳しくはこちらへ</a>
            </div>
        </li>
        @endforeach
    </ul>
</section>
@endsection
