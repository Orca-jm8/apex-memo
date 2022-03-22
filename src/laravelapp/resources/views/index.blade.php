@extends('layouts.frame')

@section('content')
<!-- Contact section-->
<div class="container">
    <div class="row">
        <aside class="col-lg-3">
        </aside>
        <article class="col-lg-6">
            <h1 class="text-center">一覧ページ</h1>
            <div>
                <div class="justify-content-center">
                    @foreach ($memos as $memo)
                    <div class="card mb-2">
                        <div class="card-header">
                            <a class="text-reset text-decoration-none" href="{{ route('memo.show', $memo->user_id) }}">{{$memo->name}}</a>
                        </div>
                        <div class="card-body">
                            <div class="card-text">{{$memo->memo}}</div>
                            <div>
                                @foreach($memo->tags as $memo_tag)
                                <span class="badge rounded-pill bg-primary">{{ $memo_tag->tag }}</span>
                                @endforeach
                            </div>
                            <div><a href="{{ route('memo.comment.index', $memo->id) }}">{{ $memo->count_comments }}件のコメント</a></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </article>
        <aside class="col-lg-3">
            <div class="card center-block">
                <div class="card-body">
                    <form action="/search" method="Get">
                        <div class="mb-2">
                            <label for="free_word" class="form-label">キーワード検索</label>
                            <input type="text" class="form-control {{ $errors->has('free_word') ? 'is-invalid' : '' }}" name="free_word" id="free_word" value="{{ old('free_word') }}">
                            @if ($errors->has('free_word'))
                            <div class="invalid-feedback">
                                {{ $errors->first('free_word') }}
                            </div>
                            @endif
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </form>
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection('contents')