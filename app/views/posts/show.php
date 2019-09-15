<?php require_once (APPROOT . '/views/inc/header.php'); ?>

<?php flash('post_message'); ?>

<div class="my-3">
	<a href="<?= URLROOT ?>/posts" class="btn btn-outline-primary"><i class="fa fa-backward"></i> Back</a>
</div>

<h1><?= $data['post']->title ?></h1>

<div class="card card-body my-3">

	<p><?= $data['post']->body ?></p>

	<div class="bg-light p-1 mb-1">
		<em> Written by <?= $data['user']->username ?> on <?= $data['post']->created_at ?> </em>
	</div>

</div>

<?php if($data['post']->user_id == $_SESSION['user_id']) : ?>

	<hr>
	<a href="<?= URLROOT . '/posts/edit/' . $data['post']->id ?>" class="btn btn-outline-dark">Edit</a>

	<form action="<?= URLROOT . '/posts/delete/' . $data['post']->id ?>" method="POST" class="pull-right">
		<input type="submit" value="Delete" class="btn btn-outline-danger">
	</form>

<?php endif; ?>

<?php require_once (APPROOT . '/views/inc/footer.php'); ?>