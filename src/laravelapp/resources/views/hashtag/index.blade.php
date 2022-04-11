@extends('layouts.frame')

@section('content')
<!-- Contact section-->

<div class="container">
    <div class="row">
        <aside class="col-lg-3">
        </aside>
        <article class="col-lg-6">
            <h3>タグ</h3>
            <ul class="p-hashtag">
                @foreach ($tags as $tag)
                <li class="p-hashtag_item"><a class="text-reset text-decoration-none" href="/hashtag/{{$tag->tag}}">{{ $tag->tag }} ({{ $tag->count_memos }})</a></li>
                @endforeach
            </ul>
        </article>
        <aside class="col-lg-3">
            <div class="card center-block">
                <div class="card-body">
                    <form action="/search" method="Get">
                        <div class="mb-2">
                            <input type="text" class="form-control {{ $errors->has('free_word') ? 'is-invalid' : '' }}" name="free_word" id="free_word" value="{{ old('free_word') }}" placeholder="キーワード検索">
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