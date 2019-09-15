<?php require_once (APPROOT . '/views/inc/header.php'); ?>

<?php flash('post_message'); ?>

<div class="row mb-3">
	<div class="col-md-6">
		<h1>Posts</h1>
	</div>
	<div class="col-md-6">
		<a href="<?= URLROOT; ?>/posts/add" class="btn btn-outline-primary pull-right">
			<i class="fa fa-pencil"></i> Add Post
		</a>
	</div>
</div>

	<?php foreach($data['posts'] as $post) : ?>
		<div class="card card-body mb-3">
			<h4 class="card-title">
				<?= $post->title . '<br>' ?>
			</h4>
			<p class="card-text line-clamp"><?= $post->body ?></p>
			<div class="bg-light p-1 mb-1">
				<em><?= 'written by ' . $post->username . ' on ' . $post->postCreated ?> </em>
			</div>
			<a href="<?= URLROOT ?>/posts/show/<?= $post->postId ?>" class="customLink">Read more...</a>
		</div>
	<?php endforeach; ?>

<?php require_once (APPROOT . '/views/inc/footer.php'); ?>