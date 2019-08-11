<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?php echo $title; ?></h1>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="d-sm-flex mt-4">
            <!-- Button Add New -->
            <a href="<?php echo base_url() ?>menu/addsubmenu" class="btn btn-success"><i class="fa fa-plus"></i> Sub Menu</a>
            <!-- Button Add New -->
        </div>

        <div class="d-sm-flex mt-4">
            <!-- search form -->
            <form action="" method="post">
                <div class="input-group">
                    <input type="text" name="search" id="search" class="form-control" placeholder="Search..." autocomplete="off" autofocus>
                    <div class="input-group-append">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                        <!-- <input type="submit" name="submit" class="btn btn-primary"> -->
                    </div>
                </div>
            </form>
            <!-- /.search form -->
        </div>
    </div>

    <section class="content-header">
        <div class="row">
            <div class="col-lg-12">
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
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Menu</th>
                            <th>Url</th>
                            <th>Icon</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($submenu) :
                            foreach ($submenu as $sm) : ?>
                                <tr>
                                    <td><?php echo ++$start; ?></td>
                                    <td><?php echo $sm['title']; ?></td>
                                    <td><?php echo $sm['menu']; ?></td>
                                    <td><?php echo $sm['url']; ?></td>
                                    <td><?php echo $sm['icon']; ?></td>
                                    <td>
                                        <?php
                                        if ($sm['is_active'] == 1) {
                                            echo "<p class='badge badge-success'>Active</p>";
                                        } else {
                                            echo "<p class='badge badge-danger'>Inactive</p>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url() ?>deletesubmenu/<?php echo $sm['id'] ?>" class="btn btn-sm btn-danger button-delete">Delete</a>
                                        <a href="<?php echo base_url() ?>menu/editsubmenu/<?php echo $sm['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="7" style="text-align: center">Data not found !</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php echo $pagination; ?>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->