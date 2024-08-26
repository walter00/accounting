<?php
require_once('../../config.php');

if(isset($_GET['id'])){
    $qry = $conn->query("SELECT i.*, a.name as account_name FROM `invoices` i 
                         JOIN `account_list` a ON i.account_id = a.id 
                         WHERE i.id = '{$_GET['id']}'");
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
    <div class="invoice-view">
        <div class="form-group">
            <label for="invoice_number" class="control-label">Invoice Number:</label>
            <p id="invoice_number"><?php echo isset($invoice_number) ? $invoice_number : '' ?></p>
        </div>

        <div class="form-group">
            <label for="account_id" class="control-label">Account:</label>
            <p id="account_id"><?php echo isset($account_name) ? $account_name : '' ?></p>
        </div>

        <div class="form-group">
            <label for="date_issued" class="control-label">Date Issued:</label>
            <p id="date_issued"><?php echo isset($date_issued) ? $date_issued : '' ?></p>
        </div>

        <div class="form-group">
            <label for="due_date" class="control-label">Due Date:</label>
            <p id="due_date"><?php echo isset($due_date) ? $due_date : '' ?></p>
        </div>

        <div class="form-group">
            <label for="amount" class="control-label">Amount:</label>
            <p id="amount"><?php echo isset($amount) ? $amount : '' ?></p>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#uni_modal #invoice-form').submit(function(e){
            e.preventDefault();
            // No form submission needed for viewing an invoice.
        })
    })
</script>