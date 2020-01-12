<?php require_once (APPROOT . '/views/inc/header.php'); ?>

<?php flash('post_message'); ?>

	<div class="row mb-3">

		
		<!-- New Task -->
		<div class="col-md-12">

			<form  action="<?= URLROOT ?>/todos/add" method="post">
				<input type="hidden" name="formAddTodo">

				<div class="input-group mb-3">

				  <input type="text" name="description" class="form-control" placeholder="New Task" value="<?= $data['description'] ?? '' ?>" >
				  
				  <div class="input-group-append">

				    <button class="btn btn-outline-primary" type="submit"><i class="fa fa-plus" aria-hidden="true"></i></button>
				  
				  </div>

				</div>
				
			</form>

		</div>
		<!-- END New Task -->
	</div>

	<div class="col-md-6">
		<h3>My To Do List:</h3>
	</div>

	<?php if($data['todos']): ?>
		
			<?php foreach ($data['todos'] as $key=>$todo): ?>

				<div class="row mb-1">
					<div class="col-md-11">
						<form action="<?= URLROOT ?>/todos/edit/<?= $todo->todo_id ?>" method="POST">
							<input type="hidden" name="formEditTodo">

							<input type="hidden" name="complete" 
							value="<?= $todo->todo_complete = $todo->todo_complete == 'yes' ? 'no' : 'yes' ?>"  >				
							
								<button type="submit" class="text-left btn-outline-secondary form-control <?= $todo->todo_complete == 'no' ? 'lineThrough' : '' ?>">
									<em><?= $key + 1 ?></em>. <strong><?= mb_strtoupper($todo->todo_description) ?></strong> 
									<span class="float-right">
										<em><?= date("d.m.Y", strtotime($todo->todo_due)) ?></em>
										<em><?= date("H:i", strtotime($todo->todo_due)) ?></em>
									</span>
								</button>

						</form>
					</div>		
					
					<div class="float-left">		
						<form action="<?= URLROOT ?>/todos/delete/<?= $todo->todo_id ?>" method="POST">
							<input type="hidden" name="formDeleteTodo">

								<button class="btn btn-outline-danger" type="submit"><i class="fa fa-minus" aria-hidden="true"></i></button>

						</form>
					</div>
				</div>

			<?php endforeach ?>
			
	<?php endif ?>




	
	





<script>

	function myFunction() {
		document.getElementById("myForm").submit();
	}

</script>


<?php require_once (APPROOT . '/views/inc/footer.php'); ?>