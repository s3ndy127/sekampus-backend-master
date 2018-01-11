@if (Auth::check())
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="https://placehold.it/160x160/00a65a/ffffff/&text={{ mb_substr(Auth::user()->name, 0, 1) }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">{{ trans('backpack::base.administration') }}</li>
      @role('Administrator')
      <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>

      <li class="treeview">
        <a href="#"><i class="fa fa-bars"></i> <span>Menu Management</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/merchant') }}"><i class="fa fa-shopping-basket"></i> <span>Merchant Management</span></a></li>

          <li class="treeview">
            <a href="#"><i class="fa fa-bars"></i> <span>seMakanan Management</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li>
                  <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/food') }}"><i class="fa fa-cutlery"></i> <span>Food</span></a>
              </li>
              <li>
                <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/catering') }}"><i class="fa fa-cutlery"></i> <span>Catering Management</span></a>
              </li>
            </ul>
          </li>

          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/sekeranjang') }}"><i class=" fa fa-cubes"></i> <span>seKeranjang Management</span></a></li>

          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/campus') }}"><i class="fa fa-graduation-cap"></i> <span>Campus Management</span></a></li>

          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/slider') }}"><i class="fa fa-caret-square-o-right"></i> <span>Slider Management</span></a></li>

          <li class="treeview">
            <a href="#"><i class="fa fa-bars"></i> <span>seKomunitas Management</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li>
                <a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/category/komunitas') }}"><i class="fa fa-clone" aria-hidden="true"></i> <span>Category</span></a>
              </li>
              <li>
                <a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/komunitas') }}"><i class="fa fa-square-o" aria-hidden="true"></i> <span>Komunitas</span></a>
              </li>
              <li>
                <a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/event/komunitas') }}"><i class="fa fa-square-o" aria-hidden="true"></i> <span>Event</span></a>
              </li>
            </ul>
          </li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#"><i class="fa fa-cart-arrow-down"></i> <span>Order Management</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/freemeal') }}"><i class="fa fa-cutlery"></i><span>Freemeal</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/cateringorder') }}"><i class="fa fa-cutlery"></i><span>seKatering</span></a></li>
          <div class="divider"></div>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/sekeranjangorder') }}"><i class="fa fa-shopping-basket"></i> <span>seKeranjang</span></a></li>
        </ul>
      </li>

      <!-- Users, Roles Permissions -->
      <li class="treeview">
        <a href="#"><i class="fa fa-group"></i> <span>Users, Roles, Permissions</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/user') }}"><i class="fa fa-user"></i> <span>Users</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/role') }}"><i class="fa fa-group"></i> <span>Roles</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/permission') }}"><i class="fa fa-key"></i> <span>Permissions</span></a></li>
        </ul>
      </li>

      <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/review') }}"><i class="fa fa-commenting"></i> <span>User Reviews</span></a></li>

      <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/setting') }}"><i class="fa fa-cogs"></i> <span>Application Setting</span></a></li>
      @endrole
      @role('merchant')
      <li class="treeview">
        <a href="#"><i class="fa fa-cart-arrow-down"></i> <span>Order Management</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/freemeal') }}"><i class="fa fa-cutlery"></i><span>Freemeal</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/cateringorder') }}"><i class="fa fa-cutlery"></i><span>seKatering</span></a></li>
          <div class="divider"></div>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/sekeranjangorder') }}"><i class="fa fa-shopping-basket"></i> <span>seKeranjang</span></a></li>
        </ul>
      </li>
      @endrole

      <li class="header">{{ trans('backpack::base.user') }}</li>
      <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/logout') }}"><i class="fa fa-sign-out"></i> <span>{{ trans('backpack::base.logout') }}</span></a></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
@endif