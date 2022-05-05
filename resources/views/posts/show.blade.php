@extends('layouts.index')

@section('content')

@if(today()->is('12-25'))
<h1>メリークリスマス</h1>
@endif

<h1>{{ $post->title }}</h1>
<p>{{ $random }}</p>
<div>{!! nl2br(e($post->body)) !!}</div>

<p>書き手：{{ $post->user->name }}</p>

<h2>コメント</h2>
@foreach($post->comments()->oldest()->get() as $comment)
    <hr>
    <p>{{ $comment->name }}（{{ $comment->created_at }}）</p>
    <p>{!! nl2br(e($comment->body)) !!}</p>
@endforeach


@endsection 