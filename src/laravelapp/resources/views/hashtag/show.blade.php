@extends('layouts.frame')

@section('content')
<!-- Contact section-->
<div class="container">
    <div class="row">
        <aside class="col-lg-3">
        </aside>
        <article class="col-lg-6">
            @foreach ($memos as $memo)
            <div class="card mb-2">
                <div class="card-header">
                    <a class="text-reset text-decoration-none" href="{{ route('users.show', $memo->user_id) }}">{{$memo->name}}</a>
                </div>
                <div class="card-body">
                    <div class="card-text">{{$memo->memo}}</div>
                    <div>
                        @foreach($memo->tags as $memo_tag)
                        <span class="badge rounded-pill bg-primary"><a class="text-reset text-decoration-none" href="/hashtag/{{$memo_tag->tag}}">{{ $memo_tag->tag }}</a></span>
                        @endforeach
                    </div>
                    <div><a href="{{ route('memos.show', $memo->id) }}">{{ $memo->count_comments }}件のコメント</a></div>
                </div>
            </div>
            @endforeach
        </article>
        <aside class="col-lg-3">
        </aside>
    </div>
</div>
@endsection('contents')