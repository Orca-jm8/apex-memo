@extends('layouts.frame')

@section('content')
<!-- Contact section-->
<div class="container">
    <div class="row">
        <aside class="col-lg-3">
        </aside>
        <article class="col-lg-6">
            <h1 class="text-center">コメント一覧</h1>
            <div class="justify-content-center">
                <div class="card mb-2">
                    <div class="card-body">
                        <p class="lead card-text">{{$memo->memo}}</p>
                    </div>
                </div>
                @foreach ($comments as $comment)
                <div class="card mb-2">
                    <div class="card-body">
                        <p class="lead card-text">{{$comment->comment}}</p>
                        @if (Auth::check() && Auth::id() === $comment->user_id)
                        <div class="mb-1">
                            <form action="{{ route('memo.comment.edit', ['memo' => $comment->memo_id, 'comment' => $comment->id]) }}">
                                @csrf
                                <input class="btn btn-success" type="submit" value="編集">
                            </form>
                        </div>
                        <div>
                            <form action="{{ route('memo.comment.destroy', ['memo' => $comment->memo_id, 'comment' => $comment->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="削除">
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('memo.comment.store', $memo->id) }}" method="POST">
                            @csrf
                            <h4>新規コメント作成</h4>
                            <div class="form-group mb-1">
                                <textarea class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" value="{{ old('comment') }}" name="comment"></textarea>
                                @if ($errors->has('comment'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('comment') }}
                                </div>
                                @endif
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <input class="btn btn-primary" type="submit" value="投稿">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </article>
        <aside class="col-lg-3">
        </aside>
    </div>
</div>
@endsection('content')