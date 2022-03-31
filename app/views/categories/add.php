<?php require APP_PATH . "/views/inc/header.php"; ?>

<a href="<?php echo ROOT; ?>/posts" class="btn btn-light">Back Button</a>
<div class="card card-body bg-light  mt-5">

    <h2>Add category</h2>
    <p>Create a category</p>
    <form action="<?php echo ROOT; ?>/Categories/add" method="post">
    <div class="form-group">
        <label for="name">name: <sup>*</sup></label>
        <input type="text" name='name' 
        class='form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>' 
        value="<?php echo $data['name'] ?>">
        <span class='invalid-feedback'><?php echo $data['name_err'] ?></span>
    </div>

		<input type='submit' class='btn btn-success' value='submit'>
    </form>
</div>



<?php require APP_PATH . "/views/inc/footer.php"; ?>