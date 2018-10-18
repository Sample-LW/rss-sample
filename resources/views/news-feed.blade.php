<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>View Feed</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Important to work AJAX CSRF -->
    <meta name="_token" content="{!! csrf_token() !!}" />

    <link rel="stylesheet" href="{{asset ('css/darkly-bootstrap.min.css')}}" media="screen">
    </head>

    <body>
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="/feed">Manage Feed</a>
              <a class="navbar-brand" href="/news-feed">View News Feed</a>
            </div>
          </div>
        </nav>

        <!-- Passing BASE URL to AJAX -->
        <input id="url" type="hidden" value="{{ \Request::url() }}">

        <div class="container">
          <div class="row">
              <div class="form-group">
                  <label for="title">Select RSS Feed:</label>
                  <select name="feed" class="form-control" style="width:50%">
                      <option value="">--- Select Feed ---</option>
                      @foreach ($feeds as $key => $value)
                          <option value="{{ $key }}">{{ $value }}</option>
                      @endforeach
                  </select>
              </div>
             
            <div id="rssOutput">RSS-feed will be listed here...</div>
          </div><!-- end row -->

        </div>

    </body>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{{asset('js/news-feed.js')}}"></script>
</html>

