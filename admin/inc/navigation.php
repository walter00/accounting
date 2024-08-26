<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-light elevation-4 sidebar-no-expand bg-gradient-navy">
    <!-- Brand Logo -->
    <a href="<?php echo base_url ?>admin" class="brand-link bg-transparent text-sm shadow-sm bg-gradient-navy">
        <img src="<?php echo validate_image($_settings->info('logo'))?>" alt="Store Logo" class="brand-image img-circle elevation-3 bg-black" style="width: 1.8rem;height: 1.8rem;max-height: unset;object-fit:scale-down;object-position:center center">
        <span class="brand-text font-weight-light"><?php echo $_settings->info('short_name') ?></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden">
        <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
            <div class="clearfix"></div>
            <!-- Sidebar Menu -->
            <nav class="">
                <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-compact nav-flat nav-child-indent nav-collapse-hide-child text-dark" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item dropdown">
                        <a href="./" class="nav-link text-light nav-home">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url ?>admin/?page=journals" class="nav-link text-light nav-journals">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Journal Entries</p>
                        </a>
                    </li>
                    <li class="nav-header">Report</li>
                    <li class="nav-item">
                        <a href="<?php echo base_url ?>admin/?page=reports/working_trial_balance" class="nav-link text-light nav-reports_working_trial_balance">
                            <i class="nav-icon fas fa-file"></i>
                            <p>Working Trial Balance</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url ?>admin/?page=reports/trial_balance" class="nav-link text-light nav-reports_trial_balance">
                            <i class="nav-icon fas fa-file"></i>
                            <p>Trial Balance</p>
                        </a>
                    </li>

                    <!-- Additional Navigation Links -->
                    <li class="nav-header">Operations</li>
                    <li class="nav-item">
                        <a href="<?php echo base_url ?>admin/?page=credit_limit" class="nav-link text-light nav-credit_limit">
                            <i class="nav-icon fas fa-credit-card"></i>
                            <p>Credit Limit</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url ?>admin/?page=outstanding_balance" class="nav-link text-light nav-outstanding_balance">
                            <i class="nav-icon fas fa-balance-scale"></i>
                            <p>Outstanding Balance</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url ?>admin/?page=invoices" class="nav-link text-light nav-create_invoice">
                            <i class="nav-icon fas fa-file-invoice"></i>
                            <p>Create Invoice</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url ?>admin/?page=invoices" class="nav-link text-light nav-view_invoices">
                            <i class="nav-icon fas fa-file-invoice-dollar"></i>
                            <p>View Invoices</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url ?>admin/?page=record_payment" class="nav-link text-light nav-record_payment">
                            <i class="nav-icon fas fa-money-check-alt"></i>
                            <p>Record Payment</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url ?>admin/?page=view_payment" class="nav-link text-light nav-view_payment">
                            <i class="nav-icon fas fa-receipt"></i>
                            <p>View Payments</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url ?>admin/?page=aging_report" class="nav-link text-light nav-aging_report">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>Aging Report</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url ?>admin/?page=manage_collection" class="nav-link text-light nav-manage_collection">
                            <i class="nav-icon fas fa-tasks"></i>
                            <p>Manage Collection</p>
                        </a>
                    </li>

                    <?php if($_settings->userdata('type') == 1): ?>
                    <li class="nav-header">Maintenance</li>
                    <li class="nav-item dropdown">
                        <a href="<?php echo base_url ?>admin/?page=groups" class="nav-link text-light nav-groups">
                            <i class="nav-icon fas fa-th-list"></i>
                            <p>Group List</p>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="<?php echo base_url ?>admin/?page=accounts" class="nav-link text-light nav-accounts">
                            <i class="nav-icon fas fa-table"></i>
                            <p>Accounts List</p>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="<?php echo base_url ?>admin/?page=user/list" class="nav-link text-light nav-user_list">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>User List</p>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="<?php echo base_url ?>admin/?page=system_info" class="nav-link text-light nav-system_info">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>Settings</p>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </div>
    <!-- /.sidebar -->
</aside>

<script>
    var page;
    $(document).ready(function(){
        page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
        page = page.replace(/\//gi,'_');

        if($('.nav-link.nav-'+page).length > 0){
            $('.nav-link.nav-'+page).addClass('active')
            $('.nav-link.nav-'+page).removeClass('text-light text-dark text-primary')
            $('.nav-link.nav-'+page).addClass('text-reset')
            if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
                $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
                $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').removeClass('text-light text-dark text-primary')
                $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('text-reset')
                $('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
            }
            if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
                $('.nav-link.nav-'+page).parent().addClass('menu-open')
            }
        }

        $('#receive-nav').click(function(){
            $('#uni_modal').on('shown.bs.modal',function(){
                $('#find-transaction [name="tracking_code"]').focus();
            })
            uni_modal("Enter Tracking Number","transaction/find_transaction.php");
        })
    })
</script>