<div class="post shadow p-4 mb-4">
	<div>
		<p>
			<span class="post-author">
				<?= htmlspecialchars($post->user()->nickname); ?>
			</span> · 
			<span class="moment-format"><?= $post->timestamp; ?></span>
		</p>
		<p><?= htmlspecialchars($post->content); ?></p>
	</div>
	<div class="comment-list">
		<?php $comments = $post->comments(); ?>

		<?php foreach ($comments as $comment) : ?>
			<?php require('comment.php'); ?>
		<?php endforeach ?>
	</div>
	<?php require('comment_form.php'); ?>

</div>