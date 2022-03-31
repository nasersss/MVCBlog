<?php require APP_PATH . '/views/inc/header.php'; ?>


<a href="<?php echo ROOT; ?>/posts" class="btn btn-outline-dark div-placement">Back Button</a>
<div class="card card-body bg-light  mt-5">

    <h2 class='font'>Edit Post</h2>
    <form action="<?php echo ROOT; ?>/posts/edit/<?php echo $data['id']; ?>" method="post">
    <div class="my-3">
       <label for='category'>Category</label>
       <select name='cat_id'>
       <?php foreach($data['categories'] as $category) : ?>

         <option value='<?= $category->id ?>'><?= $category->name ?></option>
         <?php endforeach ?>

       </select>
     </div>
    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
    <div class="form-group">
        <label class='font' for="title">Title: <sup>*</sup></label>
        <input type="text" name='title' 
        class='font form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>' 
        value="<?php echo $data['title'] ?>">
        <span class='invalid-feedback'><?php echo $data['title_err'] ?></span>
    </div>

    <div class="form-group">
        <label class='font' for="body">Body: <sup>*</sup></label>
        <textarea name='body' 
          class='font form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>'>
        <?php echo $data['body']; ?>
				</textarea>
        <span class='invalid-feedback'><?php echo $data['body_err'] ?></span>
    </div>

		<input type='submit' class='btn btn-outline-success' value='submit'>

    </form>
</div>

<?php require APP_PATH . '/views/inc/footer.php'; ?>