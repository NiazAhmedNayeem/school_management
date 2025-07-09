<!DOCTYPE html>
<html lang="en">
    
    <!-- Header -->
    @include('backend.partials.header')


    <body class="sb-nav-fixed">


        <!-- Navbar -->
        @include('backend.partials.navbar')


        <div id="layoutSidenav">

            <!-- Sidebar -->
            @include('backend.partials.sidebar')


            
            <div id="layoutSidenav_content">
                <main>

                    @yield('main-content')

                </main>
                
                <!-- Footer -->
                @include('backend.partials.footer')

            </div>
        </div>
       
        @include('backend.partials.script')
    </body>
</html>
