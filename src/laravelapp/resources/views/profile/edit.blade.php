@extends('layouts.frame')

@section('content')
<!-- Contact section-->
<div class="container py-5 my-5">
    <div class="row">
        <aside class="col-lg-3">
            <div class="profile">
                <h3>プロフィール</h3>
                @if (Auth::user()->icon)
                <img class="icon" src="{{ Auth::user()->icon }}" alt="user icon">
                @else
                <img class="icon" src="/images/guest_icon.jpg" alt="user icon">
                @endif
                <p>ユーザーネーム</p>
                <p>{{ Auth::user()->name }}</p>
                <p>ランク</p>
                @if (isset($rank->rank))
                <p>{{ $rank->rank }}</p>
                @endif
            </div>
        </aside>
        <article class="col-lg-6">
            <h1>プロフィール編集</h1>
            <div class="card px-4">
                <div class="card-body">
                    <form action="/profile_edit" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label" for="name">ユーザーネーム</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" id="name" name="name" value="{{ Auth::user()->name }}">
                            @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="rank">ランク</label>
                            <select class="form-select {{ $errors->has('rank_id') ? 'is-invalid' : '' }} " id="rank" name="rank_id">
                                <option selected>ランクを選択して下さい</option>
                                <option value="1">ブロンズⅣ</option>
                                <option value="2">ブロンズⅢ</option>
                                <option value="3">ブロンズⅡ</option>
                                <option value="4">ブロンズⅠ</option>
                                <option value="5">シルバーⅣ</option>
                                <option value="6">シルバーⅢ</option>
                                <option value="7">シルバーⅡ</option>
                                <option value="8">シルバーⅠ</option>
                                <option value="9">ゴールドⅣ</option>
                                <option value="10">ゴールドⅢ</option>
                                <option value="11">ゴールドⅡ</option>
                                <option value="12">ゴールドⅠ</option>
                                <option value="13">プラチナⅣ</option>
                                <option value="14">プラチナⅢ</option>
                                <option value="15">プラチナⅡ</option>
                                <option value="16">プラチナⅠ</option>
                                <option value="17">ダイアモンドⅣ</option>
                                <option value="18">ダイアモンドⅢ</option>
                                <option value="19">ダイアモンドⅡ</option>
                                <option value="20">ダイアモンドⅠ</option>
                                <option value="21">マスター</option>
                                <option value="22">プレデター</option>
                            </select>
                            @if ($errors->has('rank_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('rank_id') }}
                            </div>
                            @endif
                        </div>
                        <div class="mb-4">
                            <label for="formfile" class="form-label">プロフィール画像</label>
                            <input class="form-control {{ $errors->has('icon') ? 'is-invalid' : '' }}" name="icon" type="file" id="formfile" accept="image/*">
                            @if ($errors->has('icon'))
                            <div class="invalid-feedback">
                                {{ $errors->first('icon') }}
                            </div>
                            @endif
                        </div>
                        <div class="d-grid gap-2 mb-2">
                            <input class="btn btn-primary" type="submit" value="送信">
                        </div>
                    </form>
                </div>
            </div>
        </article>
        <aside class="col-lg-3">
        </aside>
    </div>
</div>
@endsection('content')