<?php if (!empty($errors)) : ?> <!-- ERROR-BOX -->
    <div class="alert alert-danger" role="alert">
      <?php foreach ($errors as $error) : ?>
        <div><?php echo $error; ?></div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <div>
    <form id="formDiv" action="" method="post" enctype="multipart/form-data">
      <!-- the enctype is responsible for image handling -->
      <div class="mb-3">
        <label class="form-label">Product Image</label>
        <br>
        <input type="file" name="image">
      </div>
      <div class="mb-3">
        <label class="form-label">Product Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $title ?>">
      </div>
      <div class="mb-3">
        <label class="form-label">Product Description</label>
        <textarea class="form-control" name="description" value="<?php echo $description ?>"></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Product price</label>
        <input type="number" step=".01" class="form-control" name="price" value="<?php echo $price ?>">
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>