<div class="comment px-4 pt-4 pb-2">
	<p>
		<span class="comment-author">
			<?= htmlspecialchars($comment->user()->nickname); ?>
		</span> · 
		<span class="moment-format"><?= $comment->timestamp; ?></span>
	</p>				
	<p><?= htmlspecialchars($comment->content); ?></p>
</div>