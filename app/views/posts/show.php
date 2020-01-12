<?php require_once (APPROOT . '/views/inc/header.php'); ?>

<?php flash('post_message'); ?>

<div class="my-3">
	<a href="<?= URLROOT ?>/posts" class="btn btn-outline-primary"><i class="fa fa-backward"></i> Back</a>
</div>

<h1><?= $data['post']->post_title ?></h1>

<div class="card card-body my-3">

	<p><?= nl2br($data['post']->post_body) ?></p>

	<div class="bg-light p-1 mb-1">

		<em>
			Written by
			<strong><?= $data['user']->user_username ?></strong> 
			on <?= date("d.m.Y", strtotime($data['post']->post_created)) ?>
			at <?= date("H:i", strtotime($data['post']->post_created)) ?>
		</em>

	</div>

</div>

<?php if($data['post']->user_id == $_SESSION['user_id']) : ?>

	<hr>
	<a href="<?= URLROOT ?>/posts/edit/<?= $data['post']->post_id ?>" class="btn btn-outline-dark">Edit</a>

	<form action="<?= URLROOT ?>/posts/delete/<?= $data['post']->post_id ?>" method="POST" class="pull-right">

		<input type="submit" value="Delete" class="btn btn-outline-danger">

	</form>

<?php endif ?>

<?php require_once (APPROOT . '/views/inc/footer.php'); ?>