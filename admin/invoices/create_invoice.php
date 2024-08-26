<?php
require_once('../../config.php');

if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `account_list` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>
<div class="container-fluid">
    <form action="" id="invoice-form">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">

        <div class="form-group">
            <label for="invoice_number" class="control-label">Invoice Number</label>
            <input type="text" name="invoice_number" id="invoice_number" class="form-control form-control-border" placeholder="Enter Invoice Number" value ="<?php echo isset($invoice_number) ? $invoice_number : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="customer_name" class="control-label">Customer Name</label>
            <input type="text" name="customer_name" id="customer_name" class="form-control form-control-border" placeholder="Enter Customer Name" value ="<?php echo isset($customer_name) ? $customer_name : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="account_id" class="control-label">Account</label>
            <select name="account_id" id="account_id" class="form-control form-control-border" required>
                <?php
                $account_qry = $conn->query("SELECT id, name FROM `account_list` where status = 1");
                while($row = $account_qry->fetch_assoc()):
                ?>
                <option value="<?php echo $row['id'] ?>" <?= isset($account_id) && $account_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="date_issued" class="control-label">Date Issued</label>
            <input type="date" name="date_issued" id="date_issued" class="form-control form-control-border" value ="<?php echo isset($date_issued) ? $date_issued : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="due_date" class="control-label">Due Date</label>
            <input type="date" name="due_date" id="due_date" class="form-control form-control-border" value ="<?php echo isset($due_date) ? $due_date : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="amount" class="control-label">Amount</label>
            <input type="number" step="any" name="amount" id="amount" class="form-control form-control-border" placeholder="Enter Amount" value ="<?php echo isset($amount) ? $amount : '' ?>" required>
        </div>
    </form>
</div>
<script>
    $(function(){
        $('#uni_modal #invoice-form').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
                el.addClass("pop-msg alert")
                el.hide()
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_invoice",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occurred",'error');
					end_loader();
				},
                success:function(resp){
                    if(resp.status == 'success'){
                        location.reload();
                    }else if(!!resp.msg){
                        el.addClass("alert-danger")
                        el.text(resp.msg)
                        _this.prepend(el)
                    }else{
                        el.addClass("alert-danger")
                        el.text("An error occurred due to an unknown reason.")
                        _this.prepend(el)
                    }
                    el.show('slow')
                    $('html,body,.modal').animate({scrollTop:0},'fast')
                    end_loader();
                }
            })
        })
    })
</script>