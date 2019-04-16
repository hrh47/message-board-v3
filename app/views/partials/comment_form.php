<div class="comment comment-form p-4">
	<form method="POST">
		<input type="hidden" name="post_id" value="<?= $post->id ?>">
		<textarea class="form-control mb-2" name="comment" placeholder="回應" required></textarea>
		<div class="d-flex justify-content-end">
			<button class="btn btn-primary" type="submit">發佈送出</button>
		</div>						
	</form>
</div>