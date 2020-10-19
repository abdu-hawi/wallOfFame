<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">

    <!-- Language -->
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" style="padding-right: .5rem;">
            <i class="fa fa-globe"></i> <span class="">{!! trans('admin.'.session('lang')) !!}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="{!! aurl('lang/en') !!}" class="dropdown-item text-gold">English</a>
            <a href="{!! aurl('lang/ar') !!}" class="dropdown-item text-gold">عربي</a>
        </div>
    </li>

    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                    <img src="{!! asset('/design/dist/img/user1-128x128.jpg') !!}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                            Brad Diesel
                            <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm">Call me whenever you can...</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                    </div>
                </div>
                <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                    <img src="{!! asset('/design/dist/img/user8-128x128.jpg') !!}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                            John Pierce
                            <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm">I got your message bro</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                    </div>
                </div>
                <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                    <img src="{!! asset('/design/dist/img/user3-128x128.jpg') !!}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                            Nora Silvester
                            <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm">The subject goes here</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                    </div>
                </div>
                <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
    </li>

    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge pending">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">
                <span class="notification-number">0</span>{!! ' '.trans('admin.Notifications') !!}
            </span>
            <div class="dropdown-divider"></div>
            @if(\App\Model\Admin\TrackCompany::query()->where("isRead","=",0)->count() > 0)
            <a href="#" class="dropdown-item" id="new_company_notification">
                <i class="far fa-chart-bar mr-2"></i>
                <span class="new-company-notification">{!! \App\Model\Admin\TrackCompany::query()->where("isRead","=",0)->count() !!}</span>{!! ' '.trans('admin.New Company') !!}
            </a>
            @endif
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
                <i class="fas fa-users mr-2"></i> 8 friend requests
                <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> 3 new reports
                <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
            <i class="fas fa-th-large"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" title="{!! trans('admin.Logout') !!}" href="{!! aurl('logout') !!}" style="padding-left: 0.4rem;">
            <i class="fas fa-sign-out-alt"></i>
        </a>
    </li>
</ul>
{{--<i class="far fa-bell notification-number"></i>--}}
{{--<span class="badge badge-warning navbar-badge pending">15</span>--}}
@push('scripts')

{{--    <script>--}}
{{--        //document.getElementsByClassName("pending")[0].textContent--}}
{{--        --}}

{{--    </script>--}}
    <script src="https://js.pusher.com/5.1/pusher.min.js"></script>
    <script >
        var pusher = new Pusher('2f74c59c6442414a73d1', {
            cluster: 'mt1',
            forceTLS: true
        });
        var notification = pusher.subscribe('new-company');
        notification.bind('new-company-event', function(data) {
            // alert(JSON.stringify(data));
            var pending = parseInt(document.getElementsByClassName("pending")[0].textContent);
            $('.pending').html(pending+1);
            var company = parseInt(document.getElementsByClassName("new-company-notification")[0].textContent);
            $('.new-company-notification').html(company+1);
            var notifiy = parseInt(document.getElementsByClassName("notification-number")[0].textContent);
            $('.notification-number').html(notifiy+1);
        });
    </script>
@endpush
