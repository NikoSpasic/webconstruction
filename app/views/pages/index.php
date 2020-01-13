
<?php require_once (APPROOT . '/views/inc/header.php'); ?>

<div class="jumbotron jumbotron-flud text-center">

	<div class="container">

		<h1 class="display-3"> <?= $data['pages']->page_title ?> </h1>

		<p class="lead text-justify"> <?= nl2br($data['pages']->page_body) ?> </p>

	</div>

</div>

<?php if ($_SESSION['user_username'] == 'admin'): ?>
		
	<a href="#" class="btn btn-outline-dark float-left">Edit</a>

<?php endif ?>

<?php require_once (APPROOT . '/views/inc/footer.php'); ?>
