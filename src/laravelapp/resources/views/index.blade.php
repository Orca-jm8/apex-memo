@extends('layouts.frame')

@section('content')
<!-- Contact section-->
<div class="container py-5 my-5">
    <div class="row">
        <aside class="col-lg-3">
        </aside>
        <article class="col-lg-6">
            <h1>一覧ページ</h1>
            <div class="px-4">
                <div class="justify-content-center">
                    @foreach ($memos as $memo)
                    <div class="card mb-2">
                        <div class="card-header">
                            <a class="nav-link" href="{{ route('memo.show', $memo->user_id) }}">{{$memo->name}}</a>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{$memo->memo}}</p>
                            <p><a href="{{ route('memo.comment.index', $memo->id) }}">{{ $memo->count_comments }}件のコメント</a></p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </article>
        <aside class="col-lg-3">
        </aside>
    </div>
</div>
@endsection('contents')