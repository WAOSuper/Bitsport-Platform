<!DOCTYPE html>
<html lang="en">
  @include('frontend.layouts.head')
  <body class="template-football" style="display: block;">
    <div class="site-wrapper clearfix">
      @include('frontend.layouts.header')
      <div class="site-content">
        <div class="container">
          <div class="row">
            @yield('content')
          </div>
        </div>
      </div>
      @include('frontend.layouts.footer')
      @include('frontend.layouts.footer-script')
    </div>
  </body>
</html>