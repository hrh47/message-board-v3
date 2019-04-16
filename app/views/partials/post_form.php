<div class="shadow mt-4 p-4 post">
	<h1>我要留言</h1>
	<form class="post-form" method="POST">
		<input name="csrf_token" type="hidden" value="<?= App\Core\App::get('session')->get('csrf_token'); ?>">
		<textarea class="form-control" name="post" placeholder="說些什麼吧～" required></textarea><br>
		<div class="d-flex justify-content-end">
			<button class="btn btn-primary" type="submit">發佈送出</button>
		</div>
	</form>
</div>		