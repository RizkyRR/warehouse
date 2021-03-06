<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="mb-4 col-md-6 mx-auto">
    <h1 class="h3 mb-2 text-gray-800"><?php echo $title; ?></h1>
  </div>

  <section class="content-header">
    <div class="row">
      <div class="col-lg-6">
        <?php if ($this->session->flashdata('success')) { ?>
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php } else if ($this->session->flashdata('error')) { ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>

  <!-- DataTales Example -->
  <div class="card shadow mb-4 col-md-6 mx-auto">
    <div class="card-body">
      <div class="table-responsive">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="">Product Name</label>
            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name..." value="<?php echo set_value('product_name'); ?>">
            <small class="form-text text-danger"><?= form_error('product_name'); ?></small>
          </div>
          <div class="form-group">
            <label for="">Brand</label>
            <select class="form-control" name="brand_id" id="brand_id">
              <option value="">Choose Brand...</option>

              <?php foreach ($brand as $b) : ?>
                <option value="<?php echo $b['brand_id'] ?>"><?php echo $b['brand_name'] ?></option>
              <?php endforeach; ?>

            </select>
            <small class="form-text text-danger"><?= form_error('brand_id'); ?></small>
          </div>
          <div class="form-group">
            <label for="">Category</label>
            <select class="form-control" name="category_id" id="category_id">
              <option value="">Choose Category...</option>

              <?php foreach ($category as $c) : ?>
                <option value="<?php echo $c['category_id'] ?>"><?php echo $c['category_name'] ?></option>
              <?php endforeach; ?>

            </select>
            <small class="form-text text-danger"><?= form_error('category_id'); ?></small>
          </div>
          <div class="form-group">
            <label for="">Supplier</label>
            <select class="form-control" name="supplier_id" id="supplier_id">
              <option value="">Choose Supplier...</option>

              <?php foreach ($supplier as $s) : ?>
                <option value="<?php echo $s['supplier_id'] ?>"><?php echo $s['supplier_name'] ?></option>
              <?php endforeach; ?>

            </select>
            <small class="form-text text-danger"><?= form_error('supplier_id'); ?></small>
          </div>
          <div class="form-group">
            <label for="">Product Image</label>
            <!-- <input type="file" class="form-control-file" name="image[]" id="image[]" multiple> -->
            <input type="file" class="form-control-file" name="image" id="image">
            <small class="form-text text-danger"><?= form_error('image'); ?></small>
          </div>
          <div class="form-group">
            <label for="">Description Product</label>
            <textarea name="description" class="form-control" id="description" rows="5" placeholder="Enter description product"><?php echo set_value('description'); ?></textarea>
            <small class="form-text text-danger"><?= form_error('description'); ?></small>
          </div>
          <div class="form-group">
            <label for="">Product Price</label>
            <input type="text" class="form-control price" id="price" name="price" placeholder="Product price..." value="<?php echo set_value('price'); ?>">
            <small class="form-text text-danger"><?= form_error('price'); ?></small>
          </div>
          <!-- /.box-body -->
          <a href="<?php echo base_url(); ?>product" class="btn btn-secondary">Back</a>
          <!-- <button type="submit" value="save" name="save" class="btn btn-success pull-right">Save</button> -->
          <input type="submit" name="save" value="Save" class="btn btn-success pull-right">
        </form>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->