@extends('layouts.frame')

@section('content')
<!-- content-->
<div class="container">
    <div class="row">
        <aside class="col-lg-3">
            <div class="profile">
                <h3>プロフィール</h3>
                @if (Auth::id() === $user_id)
                <p><a href="{{ route('users.edit', $user_id) }}">編集</a></p>
                @endif
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
            <h1 class="text-center">個人メモ一覧</h1>
            @if (Auth::id() === $user_id)
            <div class="card mb-2">
                <div class="card-body">
                    <form action="{{ route('memos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h4>新規メモ作成</h4>
                        <div class="mb-1">
                            <textarea class="form-control {{ $errors->has('memo') ? 'is-invalid' : '' }}" value="{{ old('memo') }}" name="memo" placeholder="メモを入力" onkeyup="CountDownLength( 'cdlength1' , value , 2000 );"></textarea>
                            <p id="cdlength1">あと2000文字</p>

                            @if ($errors->has('memo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('memo') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group mb-1">
                            <label for="tags">
                                タグ
                            </label>
                            <input id="tags" name="tags" class="form-control {{ $errors->has('tags') ? 'is-invalid' : '' }}" value="{{ old('tags') }}" type="text" placeholder="#tag1 #tag2...">
                            @if ($errors->has('tags'))
                            <div class="invalid-feedback">
                                {{ $errors->first('tags') }}
                            </div>
                            @endif
                        </div>

                        <div class="mb-2">
                            <label for="formfile">画像と動画</label>
                            <input class="form-control {{ $errors->has('icon') ? 'is-invalid' : '' }}" name="content" type="file" id="formfile" accept="image/*">
                            @if ($errors->has('icon'))
                            <div class="invalid-feedback">
                                {{ $errors->first('icon') }}
                            </div>
                            @endif
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <input class="btn btn-primary" type="submit" value="投稿">
                        </div>
                    </form>
                </div>
            </div>
            @endif
        </article>
        <aside class="col-lg-3">
        </aside>
    </div>
</div>
@endsection('content')