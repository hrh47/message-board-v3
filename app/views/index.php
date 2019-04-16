<div class="container">
	<div class="row">
		<div class="col-md-8 col-sm-10 m-auto">
			<?php require('partials/post_form.php'); ?>
			<div class="my-4">
				<h1 id="post-count"><?= $totalPost . ' 則留言' ?></h1>
				<div id="post-list">
					<?php foreach ($posts as $post) : ?>
						<?php require('partials/post.php'); ?>
					<?php endforeach ?>
				</div>
				<?php if ($prevUrl || $nextUrl): ?>
					<?php require('partials/pagination.php'); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>	
</div>