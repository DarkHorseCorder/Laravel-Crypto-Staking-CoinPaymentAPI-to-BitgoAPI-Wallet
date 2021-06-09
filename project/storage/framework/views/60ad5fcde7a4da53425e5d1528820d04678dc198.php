<aside class="dashboard-sidebar">
    <div class="bg--gradient">&nbsp;</div>
    <div class="dashboard-sidebar-inner">
        <div class="user-sidebar-header">
            <a href="<?php echo e(url('/')); ?>">
                <img src="<?php echo e(getPhoto($gs->header_logo)); ?>" alt="logo">
            </a>
            <div class="sidebar-close">
                <span class="close">&nbsp;</span>
            </div>
        </div>
        <div class="user-sidebar-body">
            <ul class="user-sidbar-link">
                <li>
                    <span class="subtitle"><?php echo translate('Main Menu'); ?></span>
                </li>
                <li>
                    <a href="<?php echo e(route('user.dashboard')); ?>" class="<?php echo e(menu('user.dashboard')); ?>">
                        <span class="icon"><i class="fas fa-home"></i></span>
                        <?php echo translate('User Dashboard'); ?>
                    </a>
                </li>


                <li>
                    <a href="<?php echo e(route('user.transactions')); ?>" class="<?php echo e(menu('user.transactions')); ?>">
                        <span class="icon"><i class="fas fa-history"></i></span>
                        <?php echo translate('Transactions'); ?>
                    </a>
                </li>
               

                <li>
                    <span class="subtitle"><?php echo translate('Offers and Trades'); ?></span>
                </li>
                <li>
                    <a href="<?php echo e(route('user.offer.index')); ?>" class="<?php echo e(menu('user.offer.index')); ?>">
                        <span class="icon"><i class="fas fa-gift"></i></span>
                        <?php echo translate('Your Offers'); ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('user.offer.create')); ?>" class="<?php echo e(menu('user.offer.create')); ?>">
                        <span class="icon"><i class="fas fa-folder-plus"></i></span>
                       <?php echo translate(' Create A New Offer'); ?>
                    </a>
                </li>

                <li>
                    <a href="<?php echo e(route('user.trade.all')); ?>" class="<?php echo e(menu('user.trade.all')); ?>">
                        <span class="icon"><i class="fas fa-history"></i></span>
                        <?php echo translate('My Trades'); ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('user.trade.requests')); ?>" class="<?php echo e(menu('user.trade.requests')); ?>">
                        <span class="icon"><i class="fas fa-history"></i></span>
                        <?php echo translate('Trade Requests'); ?> 
                        <?php if($trade_requests > 0): ?>
                        <span class="badge badge--base badge-sm ms-3"><?php echo e($trade_requests); ?></span>
                        <?php endif; ?>
                    </a>
                </li>

                <li>
                    <span class="subtitle"><?php echo translate('Deposit Crypto'); ?></span>
                </li>
                
                <li>
                    <a href="<?php echo e(route('user.deposit.index')); ?>" class="<?php echo e(menu('user.deposit.index')); ?>">
                        <span class="icon"><i class="fas fa-coins"></i></span>
                        <?php echo translate('My Wallet\'s'); ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('user.deposit.history')); ?>" class="<?php echo e(menu('user.deposit.history')); ?>">
                        <span class="icon"><i class="fas fa-history"></i></span>
                        <?php echo translate('Deposit History'); ?>
                    </a>
                </li>

                <li>
                    <span class="subtitle"><?php echo translate('Send Crypto'); ?></span>
                </li>
                <li>
                    <a href="<?php echo e(route('user.withdraw.wallets')); ?>" class="<?php echo e(menu('user.withdraw.wallets')); ?>">
                        <span class="icon"><i class="fas fa-file-invoice-dollar"></i></span>
                       <?php echo translate(' My Wallet\'s'); ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('user.withdraw.history')); ?>" class="<?php echo e(menu('user.withdraw.history')); ?>">
                        <span class="icon"><i class="fas fa-history"></i></span>
                        <?php echo translate('Withdraw History'); ?>
                    </a>
                </li>
                <li>
                    <span class="subtitle"><?php echo translate('Profile Settings'); ?></span>
                </li>
                <li>
                    <a href="<?php echo e(route('user.profile')); ?>" class="<?php echo e(menu('user.profile')); ?>">
                        <span class="icon"><i class="fas fa-user-circle"></i></span>
                        <?php echo translate('View/Edit Profile Settings'); ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('user.change.pass')); ?>" class="<?php echo e(menu('user.change.pass')); ?>">
                        <span class="icon"><i class="fas fa-key"></i></span>
                        <?php echo translate('Change My Password'); ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('user.verify.phone')); ?>" class="<?php echo e(menu('user.verify.phone')); ?>">
                        <span class="icon"><i class="fas fa-mobile-alt"></i></span>
                        <?php echo translate('Verify My Phone Number'); ?>
                    </a>
                </li>
                <li>
                    
                <a href="<?php echo e(route('user.two.step')); ?>" class="<?php echo e(menu('user.two.step')); ?>">
                        <span class="icon"><i class="fas fa-lock"></i></span>
                        <?php echo translate('2FA Authentication'); ?>
                    </a>
                </li>

                <li>
                    <a href="<?php echo e(route('user.ticket.index')); ?>" class="<?php echo e(menu('user.ticket.index')); ?>">
                        <span class="icon"><i class="fas fa-headset"></i></span>
                        <?php echo translate('Support'); ?>
                    </a>
                </li>
               
                <li>
                    <a href="<?php echo e(route('user.logout')); ?>">
                        <span class="icon"><i class="fas fa-sign-in-alt"></i></span>
                        <?php echo translate('Logout'); ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside><?php /**PATH C:\xampp\htdocs\custom\exchange\project\resources\views/user/partials/sidebar.blade.php ENDPATH**/ ?>