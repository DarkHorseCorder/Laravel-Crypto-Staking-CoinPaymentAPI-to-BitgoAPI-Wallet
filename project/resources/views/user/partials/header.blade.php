<div class="dashboard-header bg--gradient">
  <div class="navbar-top">
      <div class="container-fluid">
          <ul class="d-flex align-items-center justify-content-between py-1 py-md-0">
              <li>
                  <div class="nav-toggle me-3">
                      <span></span>
                      <span></span>
                      <span></span>
                  </div>
              </li>
              <li class="me-3">
                  <div class="change-language">
                    <select class="language-bar" onChange="window.location.href=this.value">
                      @foreach (DB::table('languages')->get() as $item)
                        <option value="{{route('lang.change',$item->code)}}" {{session('lang') == $item->code ? 'selected':''}}>@langg($item->language)</option>
                      @endforeach
                  </select>
                  </div>
              </li>
              <li class="ms-auto position-relative">
                  <a href="javascript:void(0)" class="dashboard-header-profile">
                      <img src="{{getPhoto(auth()->user()->photo)}}" alt="clients">
                      <div class="name d-none d-sm-block">
                          {{auth()->user()->username}}
                      </div>
                  </a>
                  <div class="user-toggle-menu">
                      <ul>
                        <li><a class="dropdown-item" href="{{route('user.profile')}}"> <i class="fas fa-user"></i>@langg('Profile Settings')</a></li>
                        <li><a class="dropdown-item" href="{{route('user.two.step')}}"><i class="fas fa-lock"></i>@langg('Two Step Authentication')</a></li>
                        <li><a class="dropdown-item" href="{{route('user.ticket.index')}}"><i class="fas fa-ticket-alt"></i> @langg('Support Ticket')</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route('user.logout')}}"><i class="fas fa-sign-out-alt"></i> @langg('Logout')</a></li>
                      </ul>
                  </div>
              </li>
              <li>
                  <div class="mode--toggle">
                      <i class="fas fa-moon"></i>
                  </div>
              </li>
          </ul>
      </div>
  </div>

</div>