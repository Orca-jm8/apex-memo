<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <title>Apex memos&comments</title>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/memo.css" rel="stylesheet" />
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
        <aside class="col-lg-3 profile">
            <h3>プロフィール</h3>
            <img src="{{ asset(Auth::user()->icon) }}" alt="user icon">
            <p>ユーザーネーム</p>
            <p>{{ Auth::user()->name }}</p>
            <p>ランク</p>
            <p>{{ $rank->rank }}</p>
        </aside>
        <article class="col-lg-6">
            <h1>個人メモ一覧</h1>
            <div class="container px-4">
                <div class="row gx-4 justify-content-center">
                    @foreach ($memos as $memo)
                    <div class="card mb-2">
                        <div class="card-body">
                            <p class="lead card-text">{{$memo->memo}}</p>
                            <p><a href="{{ route('memo.comment.index', $memo->id) }}">コメントを見る</a></p>
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
                        </div>
                    </div>
                    @endforeach
                    <div class="card">
                        <div class="card-body">
                            <form action="/memo" method="post">
                                @csrf
                                <h4>新規メモ作成</h4>
                                <div class="form-group mb-1">
                                    <textarea name="memo" class="form-control"></textarea>
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
        <aside class="col-lg-3"></aside>
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