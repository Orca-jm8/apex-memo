@extends('layouts.frame')

@section('content')
<!-- Contact section-->
<div class="container">
    <div class="row">
        <aside class="col-lg-3">
        </aside>
        <article class="col-lg-6">
            <h1 class="text-center">コメント編集画面</h1>
            <div class="container px-4">
                <div class="row gx-4 justify-content-center">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('memo.comment.update', ['memo' => $memo_id, 'comment' => $comment->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <h4>コメントを編集</h4>
                                <div class="form-group mb-1">
                                    <textarea class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" name="comment">{{ $comment->comment }}</textarea>
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
            </div>
        </article>
        <aside class="col-lg-3">
        </aside>
    </div>
</div>
@endsection('content')