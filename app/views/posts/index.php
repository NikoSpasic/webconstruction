<?php require_once (APPROOT . '/views/inc/header.php'); ?>

<?php flash('post_message'); ?>

<div class="row mb-3">

	<div class="col-md-6">
		<a href="<?= URLROOT ?>/posts/add" class="btn btn-outline-primary">
			<i class="fa fa-pencil"></i>
			Add New Post
		</a>
	</div>

</div>
	<?php if($data['posts']): ?>

		<?php foreach($data['posts'] as $post) : ?>

			<div class="card card-body mb-3">

				<h4 class="card-title">
					<?= $post->post_title . '<br>' ?>
				</h4>

				<p class="card-text line-clamp"><?= nl2br($post->post_body) ?></p>

				<div class="bg-light p-1 mb-1">
					<em>
						Written by
						<strong><?= $post->user_username ?></strong> 
						on <?= date("d.m.Y", strtotime($post->post_created)) ?>
						at <?= date("H:i", strtotime($post->post_created)) ?>
					</em>
				</div>

				<a href="<?= URLROOT ?>/posts/show/<?= $post->post_id ?>" class="customLink">Read more...</a>
			
			</div>

		<?php endforeach ?>

	<?php else: ?>

			<img src="<?= URLROOT ?>/images/posts_img/no_posts_yet.png" class="img-fluid" style="width: 100%">
			
	<?php endif ?>

	<nav aria-label="...">
		<ul class="pagination float-left">
			
			<!-- GO TO THE FIRST PAGE -->
			<li class="page-item <?= $data['pagData']['page'] <= 1 ? 'disabled' : '' ?>">
				<a class="page-link" href="<?= URLROOT ?>/posts/index/1/<?= $data['pagData']['perPage'] ?>">&laquo;</a>
			</li> &nbsp;

			<!-- PREV PAGE -->
			<li class="page-item <?= $data['pagData']['page'] <= 1 ? 'disabled' : '' ?>">
				<a class="page-link" href="<?= URLROOT ?>/posts/index/<?= $data['pagData']['page'] - 1 ?>/<?= $data['pagData']['perPage'] ?>">Prev</a>
			</li>
			
			<!-- PAGES -->
			<?php for($x = 1; $x <= $data['pagData']['pages']; $x++): ?>

				<li class="page-item <?= $data['pagData']['page'] == $x ? 'active' : '' ?>">
					<a class="page-link" href="<?= URLROOT ?>/posts/index/<?= $x ?>/<?= $data['pagData']['perPage'] ?>">
						<?= $x ?>						
					</a>
				</li>

			<?php endfor ?>

			<!-- NEXT PAGE -->
			<li class="page-item <?= $data['pagData']['page'] >= $data['pagData']['pages'] ? 'disabled' : '' ?>">
				<a class="page-link" href="<?= URLROOT ?>/posts/index/<?= $data['pagData']['page'] + 1 ?>/<?= $data['pagData']['perPage'] ?>">Next</a>
			</li> &nbsp;

			<!-- GO TO THE LAST PAGE -->
			<li class="page-item <?= $data['pagData']['page'] >= $data['pagData']['pages'] ? 'disabled' : '' ?>">
				<a class="page-link" href="<?= URLROOT ?>/posts/index/<?= $data['pagData']['pages'] ?>/<?= $data['pagData']['perPage'] ?>">&raquo;</a>
			</li>

		</ul>

		<ul class="pagination float-right">

			<li class="page-item disabled"><em class="page-link">Posts per page</em></li>

			<li class="page-item">
				<a class="page-link" href="<?= URLROOT ?>/posts/index/<?= $data['pagData']['page'] ?>/3">3</a> 
			</li>

			<li class="page-item">
				<a class="page-link" href="<?= URLROOT ?>/posts/index/<?= $data['pagData']['page'] ?>/6">6</a> 
			</li>

			<li class="page-item">
				<a class="page-link" href="<?= URLROOT ?>/posts/index/<?= $data['pagData']['page'] ?>/9">9</a> 
			</li>

			<li class="page-item">
				<a class="page-link" href="<?= URLROOT ?>/posts/index/<?= $data['pagData']['page'] ?>/12">12</a> 
			</li>

		</ul>

	</nav>

<?php require_once (APPROOT . '/views/inc/footer.php'); ?>