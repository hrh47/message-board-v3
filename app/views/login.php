<div class="container">
	<div class="row d-flex justify-content-center m-4">
		<div class="col-sm-10 col-md-8 col-lg-4">
			<?php $messages = getFlashedMessages(); ?>
			<?php if ($messages): ?>
				<?php foreach ($messages as $message): ?>
					<div class="alert alert-<?= $message['type']; ?> alert-dismissible fade show" role="alert">
						<?= $message['content']; ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
	<div class="row d-flex justify-content-center login">
		<div class="col-xs-10 col-md-8 col-lg-4 shadow p-4">
			<h1><?= $title; ?></h1>
			<form class="mb-2" id="login-form" action="/login" method="POST">
				<input class="form-control" type="text" name="username" placeholder="帳號" required>
				<input class="form-control mb-2" type="password" name="password" placeholder="密碼" required>
				<div class="form-check mb-2">
					<input class="form-check-input" type="checkbox" id="remember_me" name="remember_me" value="true">
					<label class="form-check-label" for="remember_me">記得我</label>
				</div>
				<button class="btn btn-primary" type="submit">登入</button>
			</form>
			<p>還不是會員？按此<a href="/register">註冊</a></p>
		</div>
	</div>
</div>