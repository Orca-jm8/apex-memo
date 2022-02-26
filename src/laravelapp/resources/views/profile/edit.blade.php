<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <title>Apex memos&comments</title>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
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
    <div class="container py-5 my-5">
        <div class="row">
            <aside class="col-lg-3">
                <div class="profile">
                    <h3>プロフィール</h3>
                    <img class="icon" src="{{ asset(Auth::user()->icon) }}" alt="user icon">
                    <p>ユーザーネーム</p>
                    <p>{{ Auth::user()->name }}</p>
                    <p>ランク</p>
                    <p>{{ $rank->rank }}</p>
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
                                <input class="form-control" type="text" id="name" name="name" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="rank">ランク</label>
                                <select class="form-select" id="rank" name="rank_id">
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
                            </div>
                            <div class="mb-4">
                                <label for="formfile" class="form-label">プロフィール画像</label>
                                <input class="form-control" name="icon" type="file" id="formfile" accept="image/*">
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
    <!-- Footer-->
    <footer class="fixed-bottom py-5 bg-dark">
        <div class="container px-4">
            <!--<p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p>-->
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>