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
                    <form action="{{ $blog->id ? Route('blogs.update', $blog) : Route('blogs.store') }}" method="post" name="ansform" enctype="multipart/form-data" class="max-w-screen-md grid sm:grid-cols-2 gap-4 mx-auto">
                        @csrf
                        <div class="sm:col-span-2">
                            <label for="title" class="inline-block text-gray-800 text-sm sm:text-base mb-2">タイトル</label>
                            <input type="text" name="title" value="{{ $blog->id ? $blog->title : old('title') }}" class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2"/>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="title" class="inline-block text-gray-800 text-sm sm:text-base mb-2">商品</label>
                            <select name="product_id"class ="block appearance-none w-full bg-gray-50 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                                <option value="" selected></option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" @if($blog->product_id==$product->id||old('product_id')==$product->id) selected  @endif>{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="message" class="inline-block text-gray-800 text-sm sm:text-base mb-2">本文</label>
                            <div id="editor" class="w-full h-64 bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2">{!! $blog->id ? $blog->content : old('content') !!}</div>
                            <input type="hidden" name="content">
                        </div>
                        
                        <div class="sm:col-span-2 flex justify-around items-center mt-40">
                            <a href="{{ Route('blogs.manageIndex') }}" class="inline-block bg-gray-400 hover:bg-gray-500 active:bg-gray-600 focus-visible:ring ring-indigo-300 text-white text-sm md:text-base font-semibold text-center rounded-lg outline-none transition duration-100 px-8 py-3">キャンセル</a>
                            <button name="subbtn" class="inline-block bg-blue-400 hover:bg-blue-500 active:bg-blue-600 focus-visible:ring ring-indigo-300 text-white text-sm md:text-base font-semibold text-center rounded-lg outline-none transition duration-100 px-8 py-3">{{ $submit }}</button>
                        </div>
                        <input type="hidden" name="user_id" value="1">
                        <!-- エラーになると思うのでログインできるまでは上のAuth::id()は直接数字を入れてください -->
                        @if ($blog->id)
                            <input type="hidden" name="_method" value="PUT">
                        @endif
                    </form>
                </div>
            </dic>
        </div>
    </div>
</div>
<script>
    var quill = new Quill('#editor', {
        modules: {
            toolbar: [
            ['bold', 'italic', 'underline', 'strike'],
            [{'color': []}, {'background': []}],
            ['link', 'blockquote', 'image', 'video'],
            [{ list: 'ordered' }, { list: 'bullet' }]
            ]
        },
        theme: 'snow'
    }); 
    document.ansform.subbtn.addEventListener('click', function() {
        // Quillのデータをinputに代入
        document.querySelector('input[name=content]').value = document.querySelector('.ql-editor').innerHTML;
        // 送信
        document.ansform.submit();
    });
</script>
@endsection
