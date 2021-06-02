<aside class="dashboard-sidebar">
    <div class="bg--gradient">&nbsp;</div>
    <div class="dashboard-sidebar-inner">
        <div class="user-sidebar-header">
            <a href="{{url('/')}}">
                <img src="{{getPhoto($gs->header_logo)}}" alt="logo">
            </a>
            <div class="sidebar-close">
                <span class="close">&nbsp;</span>
            </div>
        </div>
        <div class="user-sidebar-body">
            <ul class="user-sidbar-link">
                <li>
                    <span class="subtitle">@langg('Main Menu')</span>
                </li>
                <li>
                    <a href="{{route('user.dashboard')}}" class="{{menu('user.dashboard')}}">
                        <span class="icon"><i class="fas fa-home"></i></span>
                        @langg('User Dashboard')
                    </a>
                </li>


                <li>
                    <a href="{{route('user.transactions')}}" class="{{menu('user.transactions')}}">
                        <span class="icon"><i class="fas fa-history"></i></span>
                        @langg('Transactions')
                    </a>
                </li>
               

                <li>
                    <span class="subtitle">@langg('Offers and Trades')</span>
                </li>
                <li>
                    <a href="{{route('user.offer.index')}}" class="{{menu('user.offer.index')}}">
                        <span class="icon"><i class="fas fa-gift"></i></span>
                        @langg('Your Offers')
                    </a>
                </li>
                <li>
                    <a href="{{route('user.offer.create')}}" class="{{menu('user.offer.create')}}">
                        <span class="icon"><i class="fas fa-folder-plus"></i></span>
                       @langg(' Create A New Offer')
                    </a>
                </li>

                <li>
                    <a href="{{route('user.trade.all')}}" class="{{menu('user.trade.all')}}">
                        <span class="icon"><i class="fas fa-history"></i></span>
                        @langg('My Trades')
                    </a>
                </li>
                <li>
                    <a href="{{route('user.trade.requests')}}" class="{{menu('user.trade.requests')}}">
                        <span class="icon"><i class="fas fa-history"></i></span>
                        @langg('Trade Requests') 
                        @if ($trade_requests > 0)
                        <span class="badge badge--base badge-sm ms-3">{{$trade_requests}}</span>
                        @endif
                    </a>
                </li>

                <li>
                    <span class="subtitle">@langg('Deposit Crypto')</span>
                </li>
                
                <li>
                    <a href="{{route('user.deposit.index')}}" class="{{menu('user.deposit.index')}}">
                        <span class="icon"><i class="fas fa-coins"></i></span>
                        @langg('My Wallet\'s')
                    </a>
                </li>
                <li>
                    <a href="{{route('user.deposit.history')}}" class="{{menu('user.deposit.history')}}">
                        <span class="icon"><i class="fas fa-history"></i></span>
                        @langg('Deposit History')
                    </a>
                </li>

                <li>
                    <span class="subtitle">@langg('Send Crypto')</span>
                </li>
                <li>
                    <a href="{{route('user.withdraw.wallets')}}" class="{{menu('user.withdraw.wallets')}}">
                        <span class="icon"><i class="fas fa-file-invoice-dollar"></i></span>
                       @langg(' My Wallet\'s')
                    </a>
                </li>
                <li>
                    <a href="{{route('user.withdraw.history')}}" class="{{menu('user.withdraw.history')}}">
                        <span class="icon"><i class="fas fa-history"></i></span>
                        @langg('Withdraw History')
                    </a>
                </li>
                <li>
                    <span class="subtitle">@langg('Profile Settings')</span>
                </li>
                <li>
                    <a href="{{route('user.profile')}}" class="{{menu('user.profile')}}">
                        <span class="icon"><i class="fas fa-user-circle"></i></span>
                        @langg('View/Edit Profile Settings')
                    </a>
                </li>
                <li>
                    <a href="{{route('user.change.pass')}}" class="{{menu('user.change.pass')}}">
                        <span class="icon"><i class="fas fa-key"></i></span>
                        @langg('Change My Password')
                    </a>
                </li>
                <li>
                    <a href="{{route('user.verify.phone')}}" class="{{menu('user.verify.phone')}}">
                        <span class="icon"><i class="fas fa-mobile-alt"></i></span>
                        @langg('Verify My Phone Number')
                    </a>
                </li>
                <li>
                    
                <a href="{{route('user.two.step')}}" class="{{menu('user.two.step')}}">
                        <span class="icon"><i class="fas fa-lock"></i></span>
                        @langg('2FA Authentication')
                    </a>
                </li>

                <li>
                    <a href="{{route('user.ticket.index')}}" class="{{menu('user.ticket.index')}}">
                        <span class="icon"><i class="fas fa-headset"></i></span>
                        @langg('Support')
                    </a>
                </li>
               
                <li>
                    <a href="{{route('user.logout')}}">
                        <span class="icon"><i class="fas fa-sign-in-alt"></i></span>
                        @langg('Logout')
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>