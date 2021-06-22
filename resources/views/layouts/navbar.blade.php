<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">
	<div class="container-fluid">
		<a class="navbar-brand" href="/">TRPGURE</a>
		<button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="offcanvas"
			aria-label="navbar-toggler">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="dropdown-scenario" data-bs-toggle="dropdown"
						aria-expanded="false">シナリオ</a>
					<ul class="dropdown-menu" aria-labelledby="dropdown-scenario">
						<li><a class="dropdown-item" href="#">一覧</a></li>
						<li><a class="dropdown-item" href="#">管理</a></li>
						<li><a class="dropdown-item" href="#">登録</a></li>
					</ul>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">キャラクター</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="dropdown-friend" data-bs-toggle="dropdown"
						aria-expanded="false">フレンド</a>
					<ul class="dropdown-menu" aria-labelledby="dropdown-friend">
						<li><a class="dropdown-item" href="#">管理</a></li>
						<li><a class="dropdown-item" href="#">登録</a></li>
					</ul>
				</li>
				<li class="nav-item dropdown">
					<span class="nav-link dropdown-toggle" href="#" id="dropdown-user" data-bs-toggle="dropdown"
						aria-expanded="false">{{ Auth::user()->user_name }}</span>
					<ul class="dropdown-menu" aria-labelledby="dropdown-user">
						<li><a class="dropdown-item" href="{{ route('users.edit') }}">ユーザー名変更</a></li>
						<li><a class="dropdown-item" href="{{ route('users.login') }}">ログイン情報変更</a></li>
					</ul>
				</li>
			</ul>
			<div class="d-flex">
				<form action="{{ route('logout') }}" method="POST">
					@csrf
					<button class="btn btn-outline-success" type="submit">ログアウト</button>
				</form>
				{{-- <a class="btn btn-outline-success" href="{{ route('logout') }}" role="button">ログアウト</a> --}}
			</div>
			{{--<form class="d-flex">
				<input class="form-control me-2" type="search" placeholder="検索" aria-label="Search">
				<button class="btn btn-outline-success" type="submit">Search</button>
			</form>  --}}
		</div>
	</div>
</nav>