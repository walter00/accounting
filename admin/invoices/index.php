<style>
    .img-thumb-path{
        width:100px;
        height:80px;
        object-fit:scale-down;
        object-position:center center;
    }
</style>

<div class="card card-outline card-primary rounded-0 shadow">
    <div class="card-header">
        <h3 class="card-title">List of Invoices</h3>
        <div class="card-tools">
            <a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-sm btn-primary">
                <span class="fas fa-plus"></span>  Create New Invoice
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-bordered table-hover table-striped">
                <colgroup>
                    <col width="5%">
                    <col width="20%">
                    <col width="25%">
                    <col width="25%">
                    <col width="10%">
                    <col width="15%">
                </colgroup>
                <thead>
                    <tr class="bg-gradient-primary text-light">
                        <th>#</th>
                        <th>Date Created</th>
                        <th>Invoice Number</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                   <?php 
					$invoices = $conn->query("SELECT * FROM `invoice_list` ");
					while($row = $invoices->fetch_assoc()):
					?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
                            <td><?php echo $row['invoice_number'] ?></td>
                            <td><?php echo $row['customer_name'] ?></td>
                            <td class="text-center">
                                <?php 
                                    switch($row['status']){
                                        case 0:
                                            echo '<span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">Unpaid</span>';
                                            break;
                                        case 1:
                                            echo '<span class="badge badge-success bg-gradient-success px-3 rounded-pill">Paid</span>';
                                            break;
                                        default:
                                            echo '<span class="badge badge-default border px-3 rounded-pill">N/A</span>';
                                            break;
                                    }
                                ?>
                            </td>
                            <td align="center">
                                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    Action
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item view_data" href="javascript:void(0)" data-id ="<?php echo $row['id'] ?>">
                                        <span class="fa fa-eye text-dark"></span> View
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item edit_data" href="javascript:void(0)" data-id ="<?php echo $row['id'] ?>">
                                        <span class="fa fa-edit text-primary"></span> Edit
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"  data-name="<?php echo $row['invoice_number'] ?>">
                                        <span class="fa fa-trash text-danger"></span> Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#create_new').click(function(){
            uni_modal("Create New Invoice", "invoices/create_invoice.php", 'mid-large');
        });

        $('.edit_data').click(function(){
            uni_modal("Update Invoice Details", "invoices/manage_invoice.php?id="+$(this).attr('data-id'), 'mid-large');
        });

        $('.delete_data').click(function(){
            _conf("Are you sure to delete Invoice '<b>"+$(this).attr('data-name')+"</b>' permanently?", "delete_invoice", [$(this).attr('data-id')]);
        });

        $('.view_data').click(function(){
            uni_modal("Invoice Details", "invoices/view_invoice.php?id="+$(this).attr('data-id'), 'mid-large');
        });

        $('.table td, .table th').addClass('py-1 px-2 align-middle');

        $('.table').dataTable({
            columnDefs: [
                { orderable: false, targets: 5 }
            ],
        });
    });

    function delete_invoice(id){
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_invoice",
            method: "POST",
            data: {id: id},
            dataType: "json",
            error: err => {
                console.log(err);
                alert_toast("An error occurred.", 'error');
                end_loader();
            },
            success: function(resp){
                if(typeof resp == 'object' && resp.status == 'success'){
                    location.reload();
                } else {
                    alert_toast("An error occurred.", 'error');
                    end_loader();
                }
            }
        });
    }
</script>