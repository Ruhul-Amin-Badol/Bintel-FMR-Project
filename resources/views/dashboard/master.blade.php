       @include('dashboard.include.header')
       @include('dashboard.include.sidebar')

        <div class="page-wrapper">
           
          @yield('content')

        </div>
    </div>

    @include('dashboard.include.footer')

    @yield('script')
    
</body>

</html>