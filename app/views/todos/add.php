<?php require_once (APPROOT . '/views/inc/header.php'); ?>

<div class="my-3">
	<a href="<?= URLROOT ?>/todos" class="btn btn-outline-primary"><i class="fa fa-backward"></i> Back</a>
</div>

<h2>Add Todos</h2>

		<form  action="<?= URLROOT; ?>/todos/add" method="post">
			<div class="form-row align-items-center">
				<div class="col-md-11">
					<input type="text" name="description" placeholder="Type a new item here." class="form-control form-control-lg" required value="<?= $data['description']; ?>">
				</div>
				<div class="col-md-11">
					<input type="datetime-local" name="due" placeholder="Type a new item here." class="form-control form-control-lg" value="<?= $data['due']; ?>">
				</div>
				<div class="pull-right">
					<input type="submit" value="Add" class="btn btn-outline-success p-2 ml-4">
				</div>
			</div>
		</form>
 
<?php require_once (APPROOT . '/views/inc/footer.php'); ?>