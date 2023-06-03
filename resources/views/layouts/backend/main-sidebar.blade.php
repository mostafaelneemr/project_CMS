    <!-- Left Sidebar start-->
    <div class="side-menu-fixed">
        <div class="scrollbar side-menu-bg">
         <ul class="nav navbar-nav side-menu" id="sidebarnav">
           <!-- menu item Dashboard-->
           <li>
             <a href="{{route('dashboard')}}">
               <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">Dashboard</span></div>
               <div class="clearfix"></div>
             </a>
           </li>

           <!-- component -->
            <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Component</li>
           
            <!-- menu item Elements-->
            @can('home-list')
            <li>
              <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
                <div class="pull-left"><i class="ti-calendar"></i><span class="right-nav-text">Home Page</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
              </a>
              <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">  
                  
                <li> <a href="{{route('home-slider.index')}}">Slider section</a></li>
                <li> <a href="{{route('help-section.index')}}">Help section</a></li>
                <li> <a href="{{route('gallery-section.index')}}">Gallery section</a></li>
                <li> <a href="{{route('pages.index')}}">Pages</a></li>
              </ul>
            </li>
            @endcan

            @can('about-list')
           <li>
             <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
               <div class="pull-left"><i class="ti-palette"></i><span class="right-nav-text">About US</span></div>
               <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
             </a>
             <ul id="elements" class="collapse" data-parent="#sidebarnav">
              <li> <a href="{{route('about-slider.index')}}">slider section</a></li>
               <li><a href="{{route('about-section.index')}}">who we are section</a></li>
               <li><a href="{{route('about-service.index')}}">service section</a></li>
               <li><a href="{{route('about-team.index')}}">team section</a></li>
              </ul>
           </li>
           @endcan 

           @can('service-list')               
           <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#service">
              <div class="pull-left"><i class="fa fa-server"></i><span class="right-nav-text">Services</span></div>
              <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
            </a>
            <ul id="service" class="collapse" data-parent="#sidebarnav">
              <li><a href="{{route('service-slider.index')}}">service slider</a></li>
              <li><a href="{{route('service-section.index')}}">service section</a></li>
              <li><a href="{{route('logo-section.index')}}">logo section</a></li>
             </ul>
           </li>
           @endcan

           @can('blog-list')            
           <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#galley">
              <div class="pull-left"><i class="fa fa-industry"></i><span class="right-nav-text">Blog</span></div>
              <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
            </a>
            <ul id="galley" class="collapse" data-parent="#sidebarnav">
             <li><a href="{{route('blog-slider.index')}}">slider section</a></li>
             <li><a href="{{route('blog-section.index')}}">blog section</a></li>
             </ul>
           </li>
           @endcan

           @can('home-list')             
           <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#contact">
              <div class="pull-left"><i class="fa fa-phone"></i><span class="right-nav-text">contact</span></div>
              <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
            </a>
            <ul id="contact" class="collapse" data-parent="#sidebarnav">
             <li><a href="{{route('contact-slider.index')}}">slider section</a></li>
             {{-- <li><a href="{{route('blog-section.index')}}">blog section</a></li> --}}
             </ul>
           </li>
           @endcan

           @can('permessions')               
           <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Permessions</li>
            <!-- permissions-->
            <li>
              <a href="javascript:void(0);" data-toggle="collapse" data-target="#chart">
                <div class="pull-left"><i class="fa fa-user-circle-o"></i><span class="right-nav-text">Users</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
              </a>
              <ul id="chart" class="collapse" data-parent="#sidebarnav">
                @can('role-list')
                <li> <a href="{{route('roles.index')}}">roles permission</a></li>
                @endcan

                @can('user-list')
                <li> <a href="{{route('users.index')}}">users</a></li>
                @endcan
              </ul>
            </li>            
           @endcan
           </ul>
         </li>
       </ul>
     </div> 
   </div> 
   
   <!-- Left Sidebar End-->