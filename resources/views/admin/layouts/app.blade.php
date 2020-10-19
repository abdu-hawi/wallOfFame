@include('admin.layouts.head')
@include('admin.layouts.nav')
@include('admin.layouts.sidebar')
@yield('content')
@include('admin.layouts.sidebarControl')
<script>
    (function() {
        var origOpen = XMLHttpRequest.prototype.open;
        XMLHttpRequest.prototype.open = function() {
            // console.log('request started!');
            this.addEventListener('load', function() {
                // console.log('request completed!');
                // console.log(this.readyState); //will always be 4 (ajax is completed successfully)
                // console.log(this.responseText); //whatever the response was
                // console.log((JSON.parse(this.responseText)).input.order[0].column); //whatever the response was
                // console.log((JSON.parse(this.responseText)).input.order[0].dir); //whatever the response was

                sessionStorage.setItem("displayStart", (JSON.parse(this.responseText)).input.start);
                sessionStorage.setItem("pageLength", (JSON.parse(this.responseText)).input.length);
                sessionStorage.setItem("column", (JSON.parse(this.responseText)).input.order[0].column);
                sessionStorage.setItem("dir", (JSON.parse(this.responseText)).input.order[0].dir);

                // console.log(sessionStorage.getItem('a_displayStart'))
            });

            origOpen.apply(this, arguments);
        };
    })();
</script>
@include('admin.layouts.footer')
