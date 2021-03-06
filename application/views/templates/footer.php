      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; <?php echo date('Y') ?> <a href="https://goo.gl/otqUXt" target="_blank">Warehouse</a>.</span> All rights reserved.
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->
      </div>
      <!-- End of Page Wrapper -->

      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
      </a>

      <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <a class="btn btn-primary" href="<?php echo base_url() ?>auth/logout">Logout</a>
            </div>
          </div>
        </div>
      </div>
      </body>
      <!-- CLOSE ALERT AUTOMATICALLY -->
      <!-- <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
      <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script> -->


      <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

      <!-- Core plugin JavaScript-->
      <script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

      <!-- Custom scripts for all pages-->
      <script src="<?php echo base_url(); ?>assets/js/sb-admin-2.min.js"></script>

      <!-- Custom Script -->
      <script src="<?php echo base_url(); ?>assets/sweet_alert/dist/sweetalert2.all.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script>

      <script>
        window.setTimeout(function() {
          $(".alert").fadeTo(3000, 500).slideUp(500, function() {
            $(this).remove();
          });
        })
      </script>

      <script>
        $('.button-delete').on('click', function(e) {

          e.preventDefault();
          const href = $(this).attr('href');

          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete'
          }).then((result) => {
            if (result.value) {
              document.location.href = href;
            }
          });
        });
      </script>

      <!-- <script>
        $(document).ready(function() {
          $('.sidebar-menu').tree()
        })
      </script> -->

      <script>
        //untuk image file reader
        $('.custom-file-input').on('change', function() {
          let fileName = $(this).val().split('\\').pop();
          $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

        //untuk ajax role akses 
        $('.check-access').on('click', function() {
          const menuId = $(this).data('menu');
          const roleId = $(this).data('role');

          $.ajax({
            url: "<?php echo base_url('admin/accessupdate') ?>",
            type: "POST",
            data: {
              //object data: variabel(yang diambil dari checkbox)
              menuId: menuId,
              roleId: roleId
            },
            success: function() {
              document.location.href = "<?php echo base_url('admin/accessrole/'); ?>" + roleId;
            }
          });

        });
      </script>



      <script>
        $(document).ready(function() {
          $(".datepicker").datepicker({
            todayBtn: "linked",
            format: "yyyy-mm-dd",
            autoclose: true
          });
        });
      </script>

      <script src="<?php echo base_url(); ?>assets/js/format-money.js"></script>
      <!-- <script src="<?php echo base_url(); ?>assets/js/daterange-filter-purchase.js"></script> -->
      <!-- <script src="<?php echo base_url(); ?>assets/js/simple.money.format.js"></script> -->
      <!-- <script src="<?php echo base_url(); ?>assets/js/accounting.min.js"></script> -->
      <script src="<?php echo base_url(); ?>assets/js/tableNewSalesOrder.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/detail-time-order.js"></script>
      <!-- <script src="<?php echo base_url(); ?>assets/js/customer_modal_ajax.js"></script> -->

      <!-- Select2 -->
      <script src="<?php echo base_url(); ?>assets/js/select2.full.min.js"></script>
      <!-- <script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script> -->

      </html>