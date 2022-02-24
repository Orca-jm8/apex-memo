<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <title>Apex memos&comments</title>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <div class="container px-4">
            <a class="navbar-brand" href="/">Apex memo&comments</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/login">ログイン</a></li>
                    <li class="nav-item"><a class="nav-link" href="/register">新規登録</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="memo-contents wrapper">
        <aside class="profile">
            <h3>プロフィール</h3>
            <img src="{{ asset(Auth::user()->icon) }}" alt="user icon">
            <p>ユーザーネーム</p>
            <p>{{ Auth::user()->name }}</p>
            <p>ランク</p>
            <p>{{ $rank->rank }}</p>
        </aside>
        <article>
            <h1>これはあなたのメモ一覧です</h1>
            <div class="container px-4">
                <div class="row gx-4 justify-content-center">
                    @foreach ($memos as $memo)
                    <div class="col-lg-8">
                        <p class="lead"><a href="{{ route('memo.comment.index', $memo->id) }}">{{$memo->memo}}</a></p>
                        <p><a href="{{ route('memo.edit', $memo->id) }}">編集</a></p>
                        <form action="{{ route('memo.destroy', $memo->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="削除">
                        </form>
                    </div>
                    @endforeach
                    <div class="col-lg-8">
                        <form action="/memo" method="post">
                            @csrf
                            <p>新規メモ作成</p>
                            <textarea name="memo" cols="50" rows="4" class="w-full rounded-lg border-2 bg-gray-100 @error('comment') border-red-500 @enderror"></textarea>
                            <input type="submit" value="投稿">
                        </form>
                    </div>
                </div>
            </div>
        </article>
        <aside>

        </aside>
    </div>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container px-4">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>