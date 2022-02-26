<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <title>Apex memos&comments</title>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/css/styles.css" rel="stylesheet" />
    <link href="/css/memo.css" rel="stylesheet" />
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
    <!-- Contact section-->
    <div class="container py-5 my-5">
        <div class="row">
            <aside class="col-lg-3">
            </aside>
            <article class="col-lg-6">
                <h1>コメント編集画面</h1>
                <div class="container px-4">
                    <div class="row gx-4 justify-content-center">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('memo.comment.update', ['memo' => $comment->memo_id, 'comment' => $comment->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <h4>コメントを編集</h4>
                                    <div class="form-group mb-1">
                                        <textarea class="form-control" name="comment">※編集するコメントを表示する</textarea>
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