<?php
require APP_PATH . "/views/inc/header.php";
echo "<pre>";
print_r(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH));
echo "</pre>";
?>

<?php flash('post_message'); ?>
<div class="row m-2 p-3">

  <div class='col-md-8'>
    <?php
    foreach ($data['posts'] as $post) :

    ?>
      <div class="p-3 my-3">


        <h3 class=''><?php echo $post->title; ?></h3>

        <p class='font'>
          <?php echo $post->body; ?>
        </p>

        <div class='p-2 mb-3 font'>
          Written By: <?php echo $post->name ?>
        </div>
        <div class='rating-div row justify-content-around'>

          <form action="<?php echo ROOT; ?>/posts/post_like/<?php echo $post->id; ?>" method="post">
          <label for=""><?= $post->like_post?></label>   
          <button class='btn btn-success rate-form'><i class="fa fa-thumbs-up"></i></button>
          </form>

          <form action="<?php echo ROOT; ?>/posts/post_dislike/<?php echo $post->id; ?>" method="post">
           <label for=""><?=$post->dislike?></label> 
          <button class='btn btn-danger rate-form'><i class="fa fa-thumbs-down"></i></button>
          </form>
          <div class="my-4">
            <h5>
              Share to
            </h5>
            <!-- Facebook -->
            <a class="mx-3" href="http://www.facebook.com/sharer.php?u=<?php echo ROOT; ?>/posts/<?php echo $post->id; ?>" target="_blank">FaceBook</a>

            <!-- Twitter -->
            <a class="mx-3" href="http://twitter.com/share?url=<?php echo ROOT; ?>/posts/<?php echo $post->id; ?>&text=Simple Share Buttons&hashtags=simplesharebuttons" target="_blank">Twitter</a>

            <!-- Google+ -->
            <a class="mx-3" href="https://plus.google.com/share?url=<?php echo ROOT; ?>/posts/<?php echo $post->id; ?>" target="_blank">Google+</a>

           
            <!-- LinkedIn -->
            <a class="mx-3" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo ROOT; ?>/posts/<?php echo $post->id; ?>" target="_blank">LinkedIn</a>

            <!-- Email -->
            <a class="mx-3" href="mailto:?Subject=Simple Share Buttons&Body=I%20saw%20this%20and%20thought%20of%20you!%20 <?php echo ROOT; ?>/posts/<?php echo $post->id; ?>">Email</a>
          </div>
        </div>
      </div>
    <?php endforeach ?>
  </div>
  <div id="sidebar" class="four columns col-md-4">

    <div class="widget widget_categories group">
      <h3>Categories.</h3>

      <?php
      foreach ($data['categories'] as $category) : ?>
        <p><a href="<?= ROOT ?>/pages/?search&id=<?php echo $category->id; ?>"><?php echo $category->name; ?></a>
        <?php endforeach ?>
    </p>

  </div>
</div>
</div>
