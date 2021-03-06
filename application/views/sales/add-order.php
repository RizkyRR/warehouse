<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="mb-4 col-md-6">
    <h1 class="h3 mb-2 text-gray-800"><?php echo $title; ?></h1>
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
      <form action="" method="POST">
        <div class="col-md-6 col-xs-12">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="name">Customer Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter Customer's Name.." value="<?php echo set_value('name'); ?>">
              <small class="form-text text-danger"><?= form_error('name'); ?></small>
            </div>
            <div class="form-group col-md-6">
              <label for="order_date">Order Date</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input type="date" class="form-control" name="order_date" id="order_date" placeholder="Date Order.." value="<?php echo set_value('order_date'); ?>" required>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number.." value="<?php echo set_value('phone'); ?>">
            <small class="form-text text-danger"><?= form_error('phone'); ?></small>
          </div>

          <div class="form-group">
            <label for="address">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Address.."><?php echo set_value('address'); ?></textarea>
            <small class="form-text text-danger"><?= form_error('address'); ?></small>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-bordered" id="product_info_table" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th style="width:40%">Product</th>
                <th style="width:10%">Quantity</th>
                <th style="width:20%">Unit Price (Rp.)</th>
                <th style="width:20%">Amount</th>
                <th style="width:10%">
                  <button type="button" id="add_row" class="btn btn-primary btn-sm"> <i class="fas fa-plus"></i></i> </button>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr id="row_1">
                <td>
                  <select name="product[]" id="product_1" class="form-control select_group product" data-row-id="row_1" style="width: 100%;" onchange="getProductData(1)" required>
                    <option value=""></option>
                    <?php foreach ($product as $p) : ?>
                      <option value="<?php echo $p['product_id'] ?>"><?php echo $p['product_name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </td>
                <td>
                  <input type="text" name="qty[]" id="qty_1" class="form-control" required onkeyup="getTotal(1); numberFormat(this)">
                </td>
                <td>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><b>Rp</b></span>
                    </div>
                    <input type="text" name="price[]" id="price_1" class="form-control" disabled autocomplete="off">
                  </div>
                  <input type="hidden" name="price_value[]" id="price_value_1" class="form-control" autocomplete="off">
                </td>
                <td>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><b>Rp</b></span>
                    </div>
                    <input type="text" name="amount[]" id="amount_1" class="form-control" disabled autocomplete="off">
                  </div>
                  <input type="hidden" name="amount_value[]" id="amount_value_1" class="form-control" autocomplete="off">
                </td>
                <td>
                  <button type="button" class="btn btn-danger btn-sm" onclick="removeRow('1')"><i class="fas fa-times"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="col-md-3 col-xs-12">
          <div class="form-group">
            <label for="gross_amount">Gross Amount</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><b>Rp</b></span>
              </div>
              <input type="text" class="form-control" id="gross_amount" name="gross_amount" disabled autocomplete="off">
            </div>
            <input type="hidden" class="form-control" id="gross_amount_value" name="gross_amount_value" autocomplete="off">
          </div>
          <?php if ($is_service_enabled == true) : ?>
            <div class="form-group">
              <label for="service_charge">Service Charge <?php echo $company_data['service_charge_value'] ?> %</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><b>Rp</b></span>
                </div>
                <input type="text" class="form-control" id="service_charge" name="service_charge" disabled autocomplete="off">
              </div>
              <input type="hidden" class="form-control" id="service_charge_value" name="service_charge_value" autocomplete="off">
            </div>
          <?php endif; ?>
          <?php if ($is_vat_enabled == true) : ?>
            <div class="form-group">
              <label for="vat_charge">Value Added Tax <?php echo $company_data['vat_charge_value'] ?> %</label> <!-- Value Added Tax -->
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><b>Rp</b></span>
                </div>
                <input type="text" class="form-control" id="vat_charge" name="vat_charge" disabled autocomplete="off">
              </div>
              <input type="hidden" class="form-control" id="vat_charge_value" name="vat_charge_value" autocomplete="off">
            </div>
          <?php endif; ?>
          <div class="form-group">
            <label for="discount">Discount %</label>
            <div class="input-group">
              <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount..." onkeyup="subAmount(); numberFormat(this)" autocomplete="off">
              <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-percentage"></i></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="net_amount">Net Amount</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><b>Rp</b></span>
              </div>
              <input type="text" class="form-control" id="net_amount" name="net_amount" disabled autocomplete="off">
            </div>
            <input type="hidden" class="form-control" id="net_amount_value" name="net_amount_value" autocomplete="off">
          </div>
        </div>

        <a href="<?php echo base_url(); ?>sales" class="btn btn-secondary">Back</a>
        <input type="hidden" class="form-control" name="service_charge_rate" value="<?php echo $company_data['service_charge_value'] ?>" autocomplete="off">
        <input type="hidden" class="form-control" name="vat_charge_rate" value="<?php echo $company_data['vat_charge_value'] ?>" autocomplete="off">
        <input type="submit" name="save" value="Create Order" class="btn btn-success pull-right">
      </form>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<script type="text/javascript">
  var base_url = "<?php echo base_url(); ?>";

  $(document).ready(function() {
    $(".select_group").select2();
    // $("#description").wysihtml5();

    $("#mainOrdersNav").addClass('active');
    $("#addOrderNav").addClass('active');

    // Add new row in the table
    $("#add_row").unbind('click').bind('click', function() {
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
        url: base_url + 'Sales/getTableProductRow/', // base_url + 'Sales/getTableProductRow/'
        type: 'POST',
        dataType: 'JSON',
        success: function(response) {

          // console.log(reponse.x);
          var html = '<tr id="row_' + row_id + '">' +
            '<td>' +
            '<select class="form-control select_group product" data-row-id="' + row_id + '" id="product_' + row_id + '" name="product[]" style="width:100%;" onchange="getProductData(' + row_id + ')">' +
            '<option value=""></option>';
          $.each(response, function(index, value) {
            html += '<option value="' + value.product_id + '">' + value.product_name + '</option>';
          });

          html += '</select>' +
            '</td>' +
            '<td><input type="text" name="qty[]" id="qty_' + row_id + '" class="form-control" onkeyup="getTotal(' + row_id + '); numberFormat()"></td>' +
            '<td><div class="input-group"><div class="input-group-prepend"><span class="input-group-text"><b>Rp</b></span></div><input type="text" name="price[]" id="price_' + row_id + '" class="form-control" disabled></div><input type="hidden" name="price_value[]" id="price_value_' + row_id + '" class="form-control"></td>' +
            '<td><div class="input-group"><div class="input-group-prepend"><span class="input-group-text"><b>Rp</b></span></div><input type="text" name="amount[]" id="amount_' + row_id + '" class="form-control" disabled></div><input type="hidden" name="amount_value[]" id="amount_value_' + row_id + '" class="form-control"></td>' +
            '<td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(\'' + row_id + '\')"><i class="fas fa-times"></i></button></td>' +
            '</tr>';

          if (count_table_tbody_tr >= 1) {
            $("#product_info_table tbody tr:last").after(html);
          } else {
            $("#product_info_table tbody").html(html);
          }

          $(".product").select2();

        }
      });

      return false;
    });

  }); // /document

  function numberFormat(element) {
    element.value = element.value.replace(/[^0-9]+/g, "");
  }

  function getTotal(row = null) {
    if (row) {
      var total = Number($("#price_" + row).val()) * Number($("#qty_" + row).val());
      total = total.toFixed();
      $("#amount_" + row).val(total);
      $("#amount_value_" + row).val(total);

      subAmount();

    } else {
      alert('no row !! please refresh the page');
    }
  }

  // get the product information from the server
  function getProductData(row_id) {
    var product_id = $("#product_" + row_id).val();
    if (product_id == "") {
      $("#price_" + row_id).val("");
      $("#price_value_" + row_id).val("");

      $("#qty_" + row_id).val("");

      $("#amount_" + row_id).val("");
      $("#amount_value_" + row_id).val("");

    } else {
      $.ajax({
        url: base_url + 'Sales/getProductValueById', // base_url + 'Sales/getProductValueById' 
        type: 'POST',
        data: {
          product_id: product_id
        },
        dataType: 'JSON',
        success: function(response) {
          // setting the price value into the price input field

          $("#price_" + row_id).val(response.price);
          $("#price_value_" + row_id).val(response.price);

          $("#qty_" + row_id).val(1);
          $("#qty_value_" + row_id).val(1);

          var total = Number(response.price) * 1;
          total = total.toFixed();
          $("#amount_" + row_id).val(total);
          $("#amount_value_" + row_id).val(total);

          subAmount();
        } // /success
      }); // /ajax function to fetch the product data
    }
  }

  // calculate the total amount of the order
  function subAmount() {
    var service_charge = "<?php echo ($company_data['service_charge_value'] > 0) ? $company_data['service_charge_value'] : 0; ?>";
    var vat_charge = "<?php echo ($company_data['vat_charge_value'] > 0) ? $company_data['vat_charge_value'] : 0; ?>";

    var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;
    for (x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);

      totalSubAmount = Number(totalSubAmount) + Number($("#amount_" + count).val());
    } // /for

    totalSubAmount = totalSubAmount.toFixed();

    // sub total
    $("#gross_amount").val(totalSubAmount);
    $("#gross_amount_value").val(totalSubAmount);

    // vat
    var vat = (Number($("#gross_amount").val()) / 100) * vat_charge;
    vat = vat.toFixed();
    $("#vat_charge").val(vat);
    $("#vat_charge_value").val(vat);

    // service
    var service = (Number($("#gross_amount").val()) / 100) * service_charge;
    service = service.toFixed();
    $("#service_charge").val(service);
    $("#service_charge_value").val(service);

    // total amount
    var totalAmount = (Number(totalSubAmount) + Number(vat) + Number(service));
    totalAmount = totalAmount.toFixed();

    var discount = Number($("#discount").val());
    if (discount) {
      // own condition
      var getDiscount = Number(totalAmount) * (discount / 100);
      var grandTotal = Number(totalAmount) - getDiscount;

      // var grandTotal = Number(totalAmount) - Number(discount);
      grandTotal = grandTotal.toFixed();
      $("#net_amount").val(grandTotal);
      $("#net_amount_value").val(grandTotal);
    } else {
      $("#net_amount").val(totalAmount);
      $("#net_amount_value").val(totalAmount);

    } // /else discount

  } // /sub total amount

  function removeRow(tr_id) {
    $("#product_info_table tbody tr#row_" + tr_id).remove();
    subAmount();
  }
</script>