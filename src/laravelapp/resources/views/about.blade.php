@extends('layouts.frame')

@section('content')
<!-- Contact section-->

<div class="container">
    <div class="row">
        <aside class="col-lg-3">
        </aside>
        <article class="col-lg-6">
            <h1>APEX MEMOとは</h1>
            <ul>
                <li>初心者だけど、どうやって上手くなればいいかわからない</li>
                <li>それなりにやってはいるけど、最近上達しなくなってきた</li>
                <li>自分の知識やノウハウを共有してみたい</li>
            </ul>
            <p>そんな方々のために、メモ×掲示板のようなアプリとしてAPEX MEMOを作成しました。</p>
            <p>管理人はシーズン12でソロマスターを達成しておりますが、どうやって上手くなってきたかを振り返ると「ひとつひとつの技術や行動を言語化して少しづつできるようになる」ことでした。</p>
            <p>そのとき、メモ帳によく書き込んでいましたがこれを共有できるようにして自分より上手い人の考え方もみてみたいと思ったのが当アプリを制作した理由になります。</p>
            <p>自分の頭を整理するためのメモの場として、また自分以外のAPEXプレイヤーとの触れ合いの場として活用いただければ幸いです。</p>
            <p>2022.4.12 管理人 レイス2783</p>
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