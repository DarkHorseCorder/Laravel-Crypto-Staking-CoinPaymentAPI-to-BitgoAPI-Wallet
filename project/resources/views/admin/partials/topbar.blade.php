 <nav class="navbar navbar-expand-lg main-navbar">
    
          <ul class="navbar-nav mr-auto icon-menu">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li class="mt-1">
              <div class="change-language  ms-auto mr-3 text--title">
                <select class="language-bar" onChange="window.location.href=this.value">
                  @foreach (DB::table('languages')->get() as $item)
                   <option value="{{route('lang.change',$item->code)}}" {{ session('lang') == $item->code ? 'selected':''}}>@lang($item->language)</option>
                  @endforeach
                 </select>
               </div>
             </li>
          </ul>
      
        <ul class="navbar-nav navbar-right">

         <li class="">
             <a target="_blank" href="{{ route('front.index') }}" class="nav-link nav-link-lg"><i class="fas fa-home pr-1"></i></a>
         </li>
        
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{getPhoto(admin()->photo)}}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">{{admin()->email}}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
             <a href="{{route('admin.profile')}}" class="dropdown-item has-icon">
                <i class="far fa-user"></i> @langg('Profile Setting')
              </a>
             <a href="{{route('admin.password')}}" class="dropdown-item has-icon">
                <i class="fas fa-key"></i> @langg('Change Password')
              </a>
          
              <div class="dropdown-divider"></div>
              <a href="{{route('admin.logout')}}" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> @langg('Logout')
              </a>
            </div>
          </li>
        </ul>
      </nav>