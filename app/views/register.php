<div class="container">
	<div class="row d-flex justify-content-center m-4">
		<div class="col-4">
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
	<div class="row d-flex justify-content-center register">
		<div class="col-4 shadow p-4">
			<h1><?= $title; ?></h1>
			<form class="mb-2" id="register-form" action="/register" method="POST">
				<input class="form-control" name="username" type="text" placeholder="帳號" required>
				<input class="form-control" name="email" type="email" placeholder="電子郵件" required>
				<input class="form-control" name="nickname" type="text" placeholder="暱稱" required>
				<input class="form-control mb-3" name="password" type="password" placeholder="密碼" required>
				<button class="btn btn-primary" type="submit">註冊</button>
			</form>
			<p>已經是會員？按此<a href="/login">登入</a></p>
		</div>
	</div>
</div>