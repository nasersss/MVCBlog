<?php require APP_PATH . '/views/inc/header.php'; ?>


<a href="<?php echo ROOT; ?>/posts" class="btn btn-outline-dark div-placement">Back Button</a>
<div class="card card-body bg-light  mt-5">

    <h2 class='font'>Edit Category</h2>
    <form action="<?php echo ROOT; ?>/categories/edit/<?php echo $data['id']; ?>" method="post">
      <div class="form-group">
        <label for="name">name: <sup>*</sup></label>
        <input type="text" name='name' 
        class='form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>' 
        value="<?php echo $data['name'] ?>">
        <span class='invalid-feedback'><?php echo $data['name_err'] ?></span>
    </div>

    <div class="form-group">
        <label for="body">Body: <sup>*</sup></label>
        <input type="text" name='body' 
        class='form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>' 
        value="<?php echo $data['body'] ?>">
        <span class='invalid-feedback'><?php echo $data['body_err'] ?></span>
    </div>

		<input type='submit' class='btn btn-success' value='submit'>
    </form>
</div>

<?php require APP_PATH . '/views/inc/footer.php'; ?>