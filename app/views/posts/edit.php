<?php require_once (APPROOT . '/views/inc/header.php'); ?> 

<div class="my-3">
	<a href="<?= URLROOT ?>/posts" class="btn btn-outline-primary"><i class="fa fa-backward"></i> Back</a>
</div>

<h2>Edit Post</h2>

<div class="card card-body bg-light my-3">
	
	<p>Hello <?= $_SESSION['user_first_name'] . ' ' . $_SESSION['user_last_name'] ?> . You can edit a post with this form.</p>

    <form action="<?= URLROOT; ?>/posts/edit/ <?= $data['id'] ?>" method="post">
			<div class="form-group">
				<label for="title">Title: </label>
				<input type="text" name="title" class="form-control form-control-lg <?= (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['title'] ?>">
				<span class="invalid-feedback"><?= $data['title_err']; ?></span>
			</div>
			<div class="form-group">
				<label for="editor">Body: </label>
				<textarea name="body" class="form-control form-control-lg <?= (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?= $data['body'] ?></textarea>
				<span class="invalid-feedback"><?= $data['body_err']; ?></span>
			</div>
			<div>
				<input type="submit" value="Edit Post" class="btn btn-outline-danger">
			</div>
    </form>
</div>

<?php require_once (APPROOT . '/views/inc/footer.php'); ?>