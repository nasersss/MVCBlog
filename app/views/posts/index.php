<?php require APP_PATH . "/views/inc/header.php";?>

<?php flash('post_message');?>

<div class='row div-placement'>

	<div class='col-md-6'>
		<h1 class='font'>Posts</h1>
	</div>

	<div class='col-md-6'>
		<a href="<?php echo ROOT; ?>/posts/add" class='btn btn-primary pull-right'>
			<i class='fa fa-pencil'>Add Posts</i>
		</a>
	</div>

	<div class='col-md-8'>

		<?php

foreach ($data['posts'] as $post): ?>
			<div class='card card-body mb-3'>
				<h4 class="card-title"><?php echo $post->title; ?></h4>
				<div class="bg-light p-2 mb-3 font">
					Written by: <?php echo $post->name ?>
				</div>
				<p class='card-text font'>
					<?php echo $post->body; ?>
				</p>
				<?php if ($post->user_id == $_SESSION['user_id']): ?>
				<div class="row">
				<hr>
	<a href="<?php echo ROOT; ?>/posts/edit/<?php echo $post->id; ?>" class='mx-2 btn btn-outline-dark font'>Edit</a>

	<form class='float-right' action="<?php echo ROOT; ?>/posts/delete/<?php echo $post->id; ?>" method="post">
		<input type="submit" value='Delete' class='btn btn-outline-danger font'>
	</form>
				</div>

<?php endif;?>
			</div>
		<?php endforeach?>
	</div>
	<div id="sidebar" class="four columns col-md-4">

		<div class="widget widget_search">
			<h3>Search</h3>
			<form action="#">

				<input type="text" value="Search here..." onblur="if(this.value == '') { this.value = 'Search here...'; }" onfocus="if (this.value == 'Search here...') { this.value = ''; }" class="text-search">
				<input type="submit" value="" class="submit-search">

			</form>
		</div>

		<div class="widget widget_categories group">
      <h3>Categories.</h3>

	  <p><a href="<?= ROOT ?>/posts/?search=all">all</a>
      <?php
      foreach ($data['categories'] as $category) : ?>

        <p><a href="<?= ROOT ?>/posts/?search&id=<?php echo $category->id; ?>"><?php echo $category->name; ?></a>
        <?php endforeach ?>
    </p>
	<p><a href="<?= ROOT ?>/Categories/add">create category</a>

  </div>


	<?php require APP_PATH . "/views/inc/footer.php";?>