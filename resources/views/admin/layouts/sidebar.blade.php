<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{!! aurl('') !!}" class="brand-link">
        @if(!empty(setting()->icon))
            <img src="{!! Storage::url(setting()->icon) !!}" alt="English Industry" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Wall Of Fame</span>
        @else
            <span class="brand-text font-weight-light"><b>Wall Of Fame</b></span>
        @endif
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">{!! admin()->user()->name !!}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->


                <li class="nav-item">
                    <a href="{!! aurl('') !!}" class="nav-link {!! preg_match('/admin$/i',$_SERVER['REQUEST_URI'])?'active':'' !!}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {!! trans('admin.Dashboard') !!}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{!! aurl('admins') !!}" class="nav-link {!! active_menu('admin')[0] !!}">
                        <i class="nav-icon fas fa-user-astronaut"></i>
                        <p>
                            {!! trans('admin.Admin Account') !!}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{!! aurl('settings') !!}" class="nav-link {!! active_menu('settings')[0] !!}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            {!! trans('admin.Settings') !!}
                        </p>
                    </a>
                </li>

                <!-- city -->
                <li class="nav-item">
                    <a href="{!! aurl('cities') !!}" class="nav-link {!! active_menu('cities')[0] !!}">
                        <i class="nav-icon fas fa-city"></i>
                        <p>
                            {!! trans('admin.Cities') !!}
                        </p>
                    </a>
                </li>

                <!-- Subscription -->
                <li class="nav-item">
                    <a href="{!! aurl('subscriptions') !!}" class="nav-link {!! active_menu('subscriptions')[0] !!}">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>
                            {!! trans('admin.Subscriptions') !!}
                        </p>
                    </a>
                </li>

                <!-- Terms & Contracts -->
                <li class="nav-item">
                    <a href="{!! aurl('terms_contracts') !!}" class="nav-link {!! active_menu('terms_contracts')[0] !!}">
                        <i class="nav-icon fas fa-info"></i>
                        <p>
                            {!! trans('admin.Terms & Contracts') !!}
                        </p>
                    </a>
                </li>



                <!-- Models -->
                <li class="nav-item">
                    <a href="{!! aurl('models') !!}" class="nav-link {!! active_menu('models')[0] !!}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            {!! trans('admin.Models') !!}
                        </p>
                    </a>
                </li>

                <!-- Companies -->
                <li class="nav-item">
                    <a href="{!! aurl('companies') !!}" class="nav-link {!! active_menu('companies')[0] !!}">
                        <i class="nav-icon far fa-chart-bar"></i>
                        <p>
                            {!! trans('admin.Companies') !!}
                        </p>
                    </a>
                </li>

                <!-- Companies -->
                <li class="nav-item">
                    <a href="{!! aurl('quotations') !!}" class="nav-link {!! active_menu('quotations')[0] !!}">
                        <i class="nav-icon far fa-chart-bar"></i>
                        <p>
                            {!! trans('admin.QuotationPrice') !!}
                        </p>
                    </a>
                </li>


                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Starter Pages
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Active Page</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inactive Page</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Simple Link
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
