<?php require_once (APPROOT . '/views/inc/header.php'); ?>

<?php flash('post_message'); ?>



	<div class="row mb-3">

		<div class="col-md-6">
			<h1>My To Do List</h1>
		</div>
		<div class="col-md-6">
			<a href="<?= URLROOT; ?>/todos/add" class="btn btn-outline-primary pull-right">
				<i class="fa fa-pencil"></i> Add Todo
			</a>
		</div>
	</div>


	<div class="my-3 p-3 bg-white rounded box-shadow">				

		<?php foreach ($data['todos'] as $todo): ?> 
			<?php if($todo->user_id == $_SESSION['user_id']) : ?>

				<div class="card card-body my-3">
					<h2 class="<?= $todo->complete ? 'lineThrough' : '' ?>"><?= $todo->description ?></h2>
					<div class="bg-light p-1 mb-1">
						<em> Due: <?= date("d/m/Y - H:i", strtotime($todo->due)) ?></em>
					</div>
					<div class="row">
						<div class="col-md-1">
							<form action="<?= URLROOT . '/todos/edit/' . $todo->todoId ?>" method="POST">
								<input type="hidden" name="complete" value="<?= $todo->complete = 1 ?>" >
								
								<input type="submit" value="&#10004;" class="btn btn-outline-primary mt-1">
							</form>
						</div>
						<div class="col-md-1">
							<form action="<?= URLROOT . '/todos/edit/' . $todo->todoId ?>" method="POST">
								<input type="hidden" name="complete" value="<?= $todo->complete = 0 ?>" >
								
								<input type="submit" value="&#10067;" class="btn btn-outline-primary mt-1">
							</form> 
						</div>
						
						<div class="col-md-10">
							<form action="<?= URLROOT . '/todos/delete/' . $todo->todoId ?>" method="POST">
								<input type="submit" value="&#10060;" class="btn btn-outline-danger mt-1 pull-right">
							</form>
						</div>
					</div>
				</div>
		<?php endif; ?>
			<?php endforeach;  ?>
    </div>

<?php require_once (APPROOT . '/views/inc/footer.php'); ?>