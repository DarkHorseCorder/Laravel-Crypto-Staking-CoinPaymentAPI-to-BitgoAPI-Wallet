<aside id="sidebar-wrapper">

  <ul class="sidebar-menu mb-5">
      <li class="menu-header"><?php echo translate('Dashboard'); ?></li>
      <li class="nav-item <?php echo e(menu('admin.dashboard')); ?>">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link"><i class="fas fa-fire"></i><span><?php echo translate('Dashboard'); ?></span></a>
      </li>


      <?php if(access('transactions')): ?>
      <li class="nav-item <?php echo e(menu('admin.transactions')); ?>">
        <a href="<?php echo e(route('admin.transactions')); ?>" class="nav-link"><i class="fas fa-exchange-alt"></i><span><?php echo translate('Transaction Report'); ?></span></a>
      </li>
      <?php endif; ?>

      <li class="menu-header"><?php echo translate('Manage'); ?></li>
      <?php if(access('manage user')): ?>
      <li class="nav-item <?php echo e(menu(['admin.user.index','admin.user.details'])); ?>">
        <a href="<?php echo e(route('admin.user.index')); ?>" class="nav-link"><i class="fas fa-users"></i><span><?php echo translate('Manage User'); ?></span></a>
      </li>
      <?php endif; ?>
 

      <?php if(access('manage currency')): ?>
      <li class="nav-item <?php echo e(menu('admin.currency.index')); ?>">
        <a href="<?php echo e(route('admin.currency.index')); ?>" class="nav-link"><i class="fas fa-coins"></i><span><?php echo translate('Manage Currency'); ?></span></a>
      </li>
      <?php endif; ?>
 
      <?php if(access('manage country')): ?>
      <li class="nav-item <?php echo e(menu('admin.country.index')); ?>">
        <a href="<?php echo e(route('admin.country.index')); ?>" class="nav-link"> <i class="fas fa-globe"></i><span><?php echo translate('Manage Country'); ?></span></a>
      </li>
      <?php endif; ?>
      <li class="nav-item <?php echo e(menu('admin.manage.offers')); ?>">
        <a href="<?php echo e(route('admin.manage.offers')); ?>" class="nav-link"><i class="fas fa-gift"></i><span><?php echo translate('Manage Offers'); ?></span></a>
      </li>

      <li class="nav-item <?php echo e(menu('admin.manage.offers.limit')); ?>">
        <a href="<?php echo e(route('admin.manage.offers.limit')); ?>" class="nav-link"><i class="fa-solid fa-infinity"></i><span><?php echo translate('Offer Limits'); ?></span></a>
      </li>

      <li class="nav-item dropdown <?php echo e(menu('admin.trade*')); ?>">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-bars"></i> <span><?php echo translate('Manage Trades'); ?><?php if($dispute_trades > 0): ?> <small class="badge badge-primary mr-4">!</small> <?php endif; ?></span></a>
        <ul class="dropdown-menu">
        
          <li class="<?php echo e(menu('admin.trade.durations')); ?>"><a class="nav-link" href="<?php echo e(route('admin.trade.durations')); ?>"><?php echo translate('Trade Duration'); ?></a></li>

          <li class="<?php echo e(url()->current() == url('admin/trades') ? 'active':''); ?>"><a class="nav-link" href="<?php echo e(route('admin.trades.all')); ?>"><?php echo translate('All Trades'); ?></a></li>

          <li class="<?php echo e(url()->current() == url('admin/trades/disputed') ? 'active':''); ?>"><a class="nav-link <?php echo e($dispute_trades > 0 ? 'beep beep-sidebar':""); ?>" href="<?php echo e(route('admin.trades.all','disputed')); ?>"><?php echo translate('Disputed Trades'); ?></a></li>

          <li class="<?php echo e(url()->current() == url('admin/trades/completed') ? 'active':''); ?>"><a class="nav-link" href="<?php echo e(route('admin.trades.all','completed')); ?>"><?php echo translate('Completed Trades'); ?></a></li>
  
        </ul>
      </li>

      <?php if(access('manage kyc') || access('manage kyc form') || access('kyc info')): ?>
      <li class="nav-item dropdown <?php echo e(menu(['admin.manage.kyc*','admin.kyc*'])); ?>">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-align-left"></i> <span><?php echo app('translator')->get('Manage KYC'); ?>
          <?php if($pending_user_kyc > 0 ): ?> <small class="badge badge-primary mr-4">!</small> <?php endif; ?></span></a>
        <ul class="dropdown-menu">
          <?php if(access('manage kyc form')): ?>
          <li class="<?php echo e(menu(['admin.manage.kyc.form'])); ?>"><a class="nav-link" href="<?php echo e(route('admin.manage.kyc.form')); ?>"><?php echo app('translator')->get('Manage Form'); ?></a></li>
          <?php endif; ?>
          
          <?php if(access('kyc info')): ?>
          <li class="<?php echo e(url()->current() == url('admin/kyc-info') ? 'active':''); ?>"><a class="nav-link <?php echo e($pending_user_kyc > 0 ? 'beep beep-sidebar':''); ?>" href="<?php echo e(route('admin.kyc.info')); ?>"><?php echo app('translator')->get('User KYC Info'); ?></a></li>
          
          
          <?php endif; ?>
        </ul>
      </li>
      <?php endif; ?>
  

      <li class="nav-item <?php echo e(menu('admin.api.settings')); ?>">
        <a href="<?php echo e(route('admin.api.settings')); ?>" class="nav-link"><i class="fas fa-satellite-dish"></i></i><span><?php echo translate('API settings'); ?></span></a>
      </li>
     
      <li class="menu-header"><?php echo translate('Staff and Role'); ?></li>

      <?php if(access('manage role')): ?>
      <li class="nav-item <?php echo e(menu('admin.role*')); ?>">
        <a href="<?php echo e(route('admin.role.manage')); ?>" class="nav-link"><i class="fas fa-user-tag"></i><span><?php echo translate('Manage Role'); ?></span></a>
      </li>
      <?php endif; ?>
      <?php if(access('manage staff')): ?>
      <li class="nav-item <?php echo e(menu('admin.staff*')); ?>">
        <a href="<?php echo e(route('admin.staff.manage')); ?>" class="nav-link"><i class="fas fa-user-shield"></i><span><?php echo translate('Manage Staff'); ?></span></a>
      </li>
      <?php endif; ?>

      <li class="menu-header"><?php echo translate('Payment and Withdraw'); ?></li>
      <?php if(access('withdraw method') || access('pending withdraw') || access('accepted withdraw') || access('rejected withdraw')): ?>
        <li class="nav-item dropdown <?php echo e(menu('admin.withdraw*')); ?>">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-university"></i> <span><?php echo translate('Manage Withdraw'); ?><?php if($pending_withdraw > 0): ?> <small class="badge badge-primary mr-4">!</small> <?php endif; ?></span></a>
          <ul class="dropdown-menu">
           
            <?php if(access('pending withdraw')): ?>
            <li class="<?php echo e(menu('admin.withdraw.pending')); ?>"><a class="nav-link <?php echo e($pending_withdraw > 0 ? 'beep beep-sidebar':""); ?>" href="<?php echo e(route('admin.withdraw.pending')); ?>"><?php echo translate('Pending Withdraws'); ?></a></li>
            <?php endif; ?>
            <?php if(access('accepted withdraw')): ?>
            <li class="<?php echo e(menu('admin.withdraw.accepted')); ?>"><a class="nav-link" href="<?php echo e(route('admin.withdraw.accepted')); ?>"><?php echo translate('Accepted Withdraws'); ?></a></li>
            <?php endif; ?>
            <?php if(access('rejected withdraw')): ?>
            <li class="<?php echo e(menu('admin.withdraw.rejected')); ?>"><a class="nav-link" href="<?php echo e(route('admin.withdraw.rejected')); ?>"><?php echo translate('Rejected Withdraws'); ?></a></li>
            <?php endif; ?>
          </ul>
        </li>
        <?php endif; ?>
        
        
      
        <?php if(access('manage payment gateway')): ?>
        <li class="nav-item <?php echo e(menu('admin.gateway')); ?>"><a class="nav-link" href="<?php echo e(route('admin.gateway')); ?>"><i class="fas fa-money-bill"></i> <?php echo translate('Manage Gateway'); ?></a>
        </li>
        <?php endif; ?>

        <?php if(access('manage deposit')): ?>
        <li class="nav-item <?php echo e(menu('admin.deposit')); ?>"><a class="nav-link <?php echo e($pending_deposits > 0 ? 'beep beep-sidebar':""); ?>" href="<?php echo e(route('admin.deposit')); ?>"><i class="fas fa-money-bill"></i> <?php echo translate('Deposit History'); ?></a>
        </li>
        <?php endif; ?>
        
  

      <li class="menu-header"><?php echo translate('General'); ?></li>
      <?php if(access('general setting') || access('general settings logo favicon')): ?>
      <li class="nav-item dropdown <?php echo e(menu(['admin.gs*','admin.cookie'])); ?>">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cog"></i><span><?php echo translate('General Settings'); ?></span></a>
        <ul class="dropdown-menu">
          <?php if(access('general setting')): ?>
          <li class="<?php echo e(menu('admin.gs.site.settings')); ?>"><a class="nav-link" href="<?php echo e(route('admin.gs.site.settings')); ?>"><?php echo translate('Site Settings'); ?></a></li>
          <?php endif; ?>
          <?php if(access('general settings logo favicon')): ?>
          <li class="<?php echo e(menu('admin.gs.logo')); ?>"><a class="nav-link" href="<?php echo e(route('admin.gs.logo')); ?>"><?php echo translate('Logo & Favicon'); ?></a></li>
          <?php endif; ?>
          <?php if(access('manage cookie')): ?>
          <li class="<?php echo e(menu('admin.cookie')); ?>"><a class="nav-link" href="<?php echo e(route('admin.cookie')); ?>"><?php echo translate('Cookie Concent'); ?></a></li>
          <?php endif; ?>
        </ul>
      </li>
      <?php endif; ?>
      <?php if(access('manage page') || access('menu builder') || access('site contents') ||  access('manage blog-category') ||  access('manage blog') || access('seo settings')): ?>
      <li class="nav-item dropdown <?php echo e(menu(['admin.front*','admin.page*','admin.frontend*','admin.bcategory*','admin.blog*','admin.seo-setting*'])); ?>">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span><?php echo translate('Frontend Setting'); ?></span></a>
        <ul class="dropdown-menu">

          <?php if(access('manage page')): ?>
          <li class="<?php echo e(menu('admin.page.index')); ?>"><a class="nav-link" href="<?php echo e(route('admin.page.index')); ?>"><?php echo translate('Pages Settings'); ?></a></li>
          <?php endif; ?>
          
          <?php if(access('menu builder')): ?>
          <li class="<?php echo e(menu('admin.front.menu')); ?>"><a class="nav-link" href="<?php echo e(route('admin.front.menu')); ?>"><?php echo translate('Menu Builder'); ?></a></li>
          <?php endif; ?>

          <?php if(access('site contents')): ?>
          <li class="<?php echo e(menu(['admin.frontend.index','admin.frontend.edit'])); ?>"><a class="nav-link" href="<?php echo e(route('admin.frontend.index')); ?>"><?php echo translate('Site Contents'); ?></a></li>
          <?php endif; ?>

          <?php if(access('manage blog-category')): ?>
          <li class="<?php echo e(menu('admin.bcategory.index')); ?>"><a class="nav-link" href="<?php echo e(route('admin.bcategory.index')); ?>"><?php echo translate('Blog Category'); ?></a></li>
          <?php endif; ?>

          <?php if(access('manage blog')): ?>
          <li class="<?php echo e(menu(['admin.blog.index','admin.blog.create','admin.blog.edit'])); ?>"><a class="nav-link" href="<?php echo e(route('admin.blog.index')); ?>"><?php echo translate('Manage Blog'); ?></a></li>
          <?php endif; ?>

          <?php if(access('seo settings')): ?>
          <li class="<?php echo e(menu('admin.seo-setting.index')); ?>"><a class="nav-link" href="<?php echo e(route('admin.seo-setting.index')); ?>"><?php echo translate('Seo Settings'); ?></a></li>
          <?php endif; ?>
        </ul>
      </li>
      <?php endif; ?>

      <?php if(access('email templates') || access('email config') || access('group email')): ?>
      <li class="nav-item dropdown <?php echo e(menu('admin.mail*')); ?>">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-envelope-square"></i> <span><?php echo translate('Email Settings'); ?></span></a>
        <ul class="dropdown-menu">
          <?php if(access('email templates')): ?>
          <li class="<?php echo e(menu('admin.mail.index')); ?>"><a class="nav-link" href="<?php echo e(route('admin.mail.index')); ?>"><?php echo translate('Email Templates'); ?></a></li>
          <?php endif; ?>
          <?php if(access('email config')): ?>
          <li class="<?php echo e(menu('admin.mail.config')); ?>"><a class="nav-link" href="<?php echo e(route('admin.mail.config')); ?>"><?php echo translate('Email Config'); ?></a></li>
          <?php endif; ?>
          <?php if(access('group email')): ?>
          <li class="<?php echo e(menu('admin.mail.group.show')); ?>"><a class="nav-link" href="<?php echo e(route('admin.mail.group.show')); ?>"><?php echo translate('Group Emails'); ?></a></li>
          <?php endif; ?>
        </ul>
      </li>
     
      <?php endif; ?>
      <?php if(access('sms gateways') || access('sms templates')): ?>
      <li class="nav-item dropdown <?php echo e(menu('admin.sms*')); ?>">
        <a href="#" class="nav-link has-dropdown"><i class="far fa-comment-alt"></i> <span><?php echo translate('SMS Settings'); ?></span></a>
        <ul class="dropdown-menu">
          <?php if(access('sms gateways')): ?>
          <li class="<?php echo e(menu('admin.sms.index')); ?>"><a class="nav-link" href="<?php echo e(route('admin.sms.index')); ?>"><?php echo translate('SMS Gateway'); ?></a></li>
          <?php endif; ?>

          <?php if(access('sms templates')): ?>
          <li class="<?php echo e(menu('admin.sms.templates')); ?>"><a class="nav-link" href="<?php echo e(route('admin.sms.templates')); ?>"><?php echo translate('SMS Template'); ?></a></li>
          <?php endif; ?>
        </ul>
      </li>
      <?php endif; ?>
    
      <?php if(access('manage language')): ?>
      <li class="nav-item <?php echo e(menu(['admin.language*'])); ?>">
        <a href="<?php echo e(route('admin.language.index')); ?>" class="nav-link"><i class="fas fa-language"></i> <span><?php echo translate('Manage Language'); ?></span></a>
      </li>
      <?php endif; ?>

      <?php if(access('manage ticket')): ?>
     

          <li class="nav-item <?php echo e(menu('admin.ticket.manage')); ?>"><a class="nav-link <?php echo e($pending_user_ticket > 0 ? 'beep beep-sidebar':""); ?>" href="<?php echo e(route('admin.ticket.manage')); ?>"><i class="fas fa-ticket-alt"></i><?php echo translate('Support Tickets'); ?></a>
          </li>

       
    <?php endif; ?>
    </ul>
</aside><?php /**PATH C:\xampp\htdocs\custom\exchange\project\resources\views/admin/partials/sidebar.blade.php ENDPATH**/ ?>