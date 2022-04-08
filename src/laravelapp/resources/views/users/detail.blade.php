@extends('layouts.memos')

@section('content')
<!-- content-->
<div class="container">
    <div class="row">
        <aside class="col-lg-3">
            <div class="profile">
                <h3>プロフィール</h3>
                @if ($icon)
                <img class="icon" src="{{ $icon }}" alt="user icon">
                @else
                <img class="icon" src="/images/guest_icon.jpg" alt="user icon">
                @endif
                <p>ユーザーネーム</p>
                <p>{{ $name }}</p>
                <p>ランク</p>
                @if (isset($rank->rank))
                <p>{{ $rank->rank }}</p>
                @endif
            </div>
        </aside>
        <article class="col-lg-6">
            <div class="result_memos">
                @foreach ($memos as $memo)
                <div class="info card mb-2">
                    <div class="card-body">
                        <div class="card-text">{{$memo->memo}}</div>
                        @if ($memo->content)
                        <figure class="figure">
                            <img src="{{ $memo->content }}" class="figure-img img-fluid rounded" alt="...">
                        </figure>
                        @endif
                        @if ($memo->video)
                        <div class="ratio ratio-4x3">
                            <video src="{{ $memo->video }}" controls></video>
                        </div>
                        @endif
                        <div>
                            @foreach($memo->tags as $memo_tag)
                            <span class="badge rounded-pill bg-primary"><a class="text-reset text-decoration-none" href="/hashtag/{{$memo_tag->tag}}">{{ $memo_tag->tag }}</a></span>
                            @endforeach
                        </div>
                        <div><a href="{{ route('memos.show', $memo->id) }}">{{ $memo->count_comments }}件のコメント</a></div>
                    </div>
                </div>
                @endforeach

                @if ($memos->hasMorePages())
                <p class="button more"><a href="{{ $memos->nextPageUrl() }}">もっと見る</a></p>
                @endif
            </div>
        </article>
        <aside class="col-lg-3">
        </aside>
    </div>
</div>
@endsection('content')