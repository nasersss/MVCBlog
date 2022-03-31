<?php require APP_PATH . "/views/inc/header.php"; ?>

<a href="<?php echo ROOT; ?>/posts" class="btn btn-light">Back Button</a>
<div class="card card-body bg-light  mt-5">

    <h2>Add Post</h2>
    <p>Create a Post</p>
    <form action="<?php echo ROOT; ?>/posts/add" method="post">
    <div class="my-3">
       <label for='category'>Category</label>
       <select name='cat_id'>
       <?php foreach($data['categories'] as $category) : ?>

         <option value='<?= $category->id ?>'><?= $category->name ?></option>
         <?php endforeach ?>

       </select>
     </div>

    <div class="form-group">
        <label for="title">Title: <sup>*</sup></label>
        <input type="text" name='title' 
        class='form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>' 
        value="<?php echo $data['title'] ?>">
        <span class='invalid-feedback'><?php echo $data['title_err'] ?></span>
    </div>

    <div class="form-group">
        <label for="body">Body: <sup>*</sup></label>
        <textarea name='body' 
          class='form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>'>
        <?php echo $data['body']; ?>
				</textarea>
        <span class='invalid-feedback'><?php echo $data['body_err'] ?></span>
    </div>

		<input type='submit' class='btn btn-success' value='submit'>

    </form>
</div>



<?php require APP_PATH . "/views/inc/footer.php"; ?>