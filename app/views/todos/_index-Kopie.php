<?php require_once (APPROOT . '/views/inc/header.php'); ?>

<?php flash('post_message'); ?>

	<div class="row mb-3">

		<div class="col-md-6">
			<h1>My To Do List:</h1>
		</div>

		<div class="col-md-6">
			<a href="<?= URLROOT ?>/todos/add" class="btn btn-outline-primary pull-right">
				<i class="fa fa-pencil"></i> Add Todo
			</a>
		</div>

	</div>
	<?php if($data['todos']): ?>

		<div class="my-3 p-3 bg-white rounded box-shadow">		
		
			<?php foreach ($data['todos'] as $todo): ?>

				<div class="card card-body my-3">

					<h2 class="<?= $todo->todo_complete ? 'lineThrough' : '' ?>"><?= $todo->todo_description ?></h2>

					<div class="bg-light p-1 mb-1">
						<em><?= date("d.m.Y", strtotime($todo->todo_due)) ?></em>
						<em><?= date("H:i", strtotime($todo->todo_due)) ?></em>
					</div>

					<div class="row">

						<div class="col-md-1">

							<form action="<?= URLROOT ?>/todos/edit/<?= $todo->todo_id ?>" method="POST">

								<input type="hidden" name="complete" value="<?= $todo->todo_complete = 1 ?>" >							
								<input type="submit" value="&#10004;" class="btn btn-outline-primary mt-1">

							</form>

						</div>
						
						<div class="col-md-10">

							<form action="<?= URLROOT ?>/todos/delete/<?= $todo->todo_id ?>" method="POST">

								<input type="submit" value="&#10060;" class="btn btn-outline-danger mt-1 pull-right">

							</form>

						</div>

					</div>

				</div>
<?php var_dump($todo->todo_complete) ?>
			<?php endforeach ?>

		</div>

	<?php else: ?>

		<img src="<?= URLROOT ?>/images/posts_img/nothing_todo.jpg" class="img-fluid" style="width: 100%">
			
	<?php endif ?>

<?php require_once (APPROOT . '/views/inc/footer.php'); ?>