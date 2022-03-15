@extends('layouts.frame')

@section('content')
<<!-- content-->>
    <div class="container py-5 my-5">
        <div class="row">
            <aside class="col-lg-3">
                <div class="profile">
                    <h3>プロフィール</h3>
                    @if (Auth::id() === $user_id)
                    <p><a href="/profile_edit">編集</a></p>
                    @endif
                    <img class="icon" src="{{ $icon }}" alt="user icon">
                    <p>ユーザーネーム</p>
                    <p>{{ $name }}</p>
                    <p>ランク</p>
                    @if (isset($rank->rank))
                    <p>{{ $rank->rank }}</p>
                    @endif
                </div>
            </aside>
            <article class="col-lg-6">
                <h1>個人メモ一覧</h1>
                <div class="px-4">
                    <div class="justify-content-center">
                        @foreach ($memos as $memo)
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="lead card-text">{{$memo->memo}}</div>

                                <div>
                                    @foreach($memo->tags as $memo_tag)
                                    <span class="badge rounded-pill bg-primary">{{ $memo_tag->tag }}</span>
                                    @endforeach
                                </div>

                                <p><a href="{{ route('memo.comment.index', $memo->id) }}">{{ $memo->count_comments }}件のコメント</a></p>
                                @if (Auth::id() === $user_id)
                                <div class="mb-1">
                                    <form action="{{ route('memo.edit', $memo->id) }}" method="GET">
                                        @csrf
                                        <input class="btn btn-success" type="submit" value="編集">
                                    </form>
                                </div>
                                <div>
                                    <form action="{{ route('memo.destroy', $memo->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input class="btn btn-danger" type="submit" value="削除">
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        @if (Auth::id() === $user_id)
                        <div class="card">
                            <div class="card-body">
                                <form action="/memo" method="POST">
                                    @csrf
                                    <h4>新規メモ作成</h4>
                                    <div class="mb-1">
                                        <textarea class="form-control" name="memo"></textarea>
                                    </div>

                                    <div class="form-group mb-1">
                                        <label for="tags">
                                            タグ
                                        </label>
                                        <input id="tags" name="tags" class="form-control {{ $errors->has('tags') ? 'is-invalid' : '' }}" value="{{ old('tags') }}" type="text">
                                        @if ($errors->has('tags'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('tags') }}
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
                    </div>
                </div>
            </article>
            <aside class="col-lg-3">
            </aside>
        </div>
    </div>
    @endsection('content')