<!-- Modal 로그인 -->
<div id="modal-login" class="modal zoom">
	<header class="bar bar-nav bar-light bg-faded p-x-0">
		<a class="icon icon-left-nav pull-left p-x-1" role="button" data-history="back"></a>
		<h1 class="title" data-role="title">로그인</h1>
	</header>

	<main class="content">
		<form id="modal-login-form" action="<?php echo $g['s']?>/" method="post" autocomplete="off">
			<input type="hidden" name="r" value="<?php echo $r?>">
			<input type="hidden" name="a" value="login">
			<input type="hidden" name="referer" value="<?php echo $referer ? $referer : $_SERVER['REQUEST_URI']?>">

			<div class="card">
	      <div class="form-list">
	        <input type="text" placeholder="아이디" name="id" required autocapitalize="off" autocorrect="off">
					<div class="invalid-feedback">
						아이디를 입력해 주세요.
					</div>
	        <input type="password" placeholder="패스워드" name="pw" required autocapitalize="off" autocorrect="off">
	      </div>
	    </div>

			<div class="content-padded">
				<div class="p-y-1">
					<label class="custom-control custom-checkbox">
					  <input type="checkbox" class="custom-control-input" name="login_cookie" value="checked" checked>
					  <span class="custom-control-indicator"></span>
					  <span class="custom-control-description">로그인 상태 유지</span>
					</label>
				</div>
				<button type="submit" class="btn btn-primary btn-lg btn-block js-submit">
					<span class="not-loading">로그인</span>
	        <span class="is-loading"><i class="fa fa-spinner fa-lg fa-spin fa-fw"></i> 로그인중 ...</span>
				</button>
				<a class="btn btn-outline-primary btn-block" href="<?php echo RW('mod=join') ?>" role="button">회원가입</a>
			</div>
		</form>
		<p class="m-t-2 content-padded"><a href="<?php echo $g['s']?>/?m=member&front=login&page=password_reset" class="muted-link">비밀번호를 잊으셨나요?</a></p>
	</main>
</div><!-- /.modal -->

<!-- Modal 통합검색 -->
<div id="modal-search" class="modal zoom">
	<header class="bar bar-nav bg-white p-2">
	  <form class="input-group input-group-lg border border-primary" action="<?php echo $g['s']?>/" id="modal-search-form">
			<input type="hidden" name="r" value="<?php echo $r?>">
	    <input type="hidden" name="m" value="search">
	    <input type="search" name="keyword" class="form-control bg-white" placeholder="검색어 입력" id="search-input" required autocomplete="off">
			<span class="input-group-btn hidden" data-role="keyword-reset" >
	      <button class="btn btn-link pr-2" type="button" data-act="keyword-reset" tabindex="-1">
	        <i class="fa fa-times-circle" aria-hidden="true"></i>
	      </button>
	    </span>
			<span class="input-group-btn">
			  <button class="btn btn-link text-primary" type="submit" id="modal-search-submit">
					<i class="fa fa-search" aria-hidden="true"></i>
				</button>
			</span>
	  </form>
	</header>
	<nav class="bar bar-tab bar-light bg-faded bg-white">
	  <a class="tab-item" role="button" data-history="back">
	    취소
	  </a>
	</nav>

	<main class="content bg-faded">
		<div class="content-padded">

		</div>
	</main>
</div><!-- /.modal -->

<!-- Modal 사이트맵 -->
<div id="modal-sitemap" class="modal zoom">
	<header class="bar bar-nav bar-light bg-faded p-x-0">
		<a class="icon icon-left-nav pull-left p-x-1" role="button" data-history="back"></a>
		<h1 class="title" data-role="title">사이드맵</h1>
	</header>

	<main class="content">
		<div class="content-padded">
			<?php getWidget('rc-simple/sitemap',array())?>
		</div>
	</main>
</div><!-- /.modal -->

<!-- Modal : 메뉴 보기 -->
<div id="modal-menu-view" class="modal zoom">
  <input type="hidden" name="uid" value="">
  <header class="bar bar-nav bar-light bg-faded px-0">
		<a class="icon icon-left-nav pull-left p-x-1" role="button" data-history="back"></a>
		<h1 class="title" data-role="title">
			메뉴 제목
		</h1>
  </header>
  <div class="content" >
		<div class="cover">
			<div class="cover-backdrop"></div>
			<div class="cover-overlay">
				<h4 class="cover-title" data-role="title"></h4>
				<p class="cover-text" data-role="caption"></p>
			</div>
		</div><!-- /.cover -->
		<div class="content-padded">
			<div class="markdown-body" data-role="article"></div>
			<button class="btn btn-secondary btn-block mt-3" data-scroll="top">위로가기</button>
		</div>
  </div><!-- /.content -->
</div><!-- /.modal -->

<!-- Modal : 동영상보기 -->
<div class="modal zoom" id="modal-vod">
	<header class="bar bar-nav bar-light bg-faded px-0">
		<a class="icon icon-left-nav pull-left p-x-1" role="button" data-history="back"></a>
		<h1 class="title" data-role="title">
			제목
		</h1>
  </header>
  <div class="content">
  </div>
</div>
