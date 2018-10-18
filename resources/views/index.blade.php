<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>RSS Feed</title>
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

        <div class="container">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <button id="btn_add" name="btn_add" class="btn btn-default pull-right">Add/Subcribe New Feed</button>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-9 col-md-offset-1">
                    <table class="table table-striped table-hover ">
                        <thead>
                            <tr class="info">
                              <th>ID </th>
                              <th>URL</th>
                              <th>Description</th>
                              <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="feeds-list" name="feeds-list">
                            @foreach ($feeds as $feed)
                              <tr id="feed{{$feed->id}}" class="active">
                                  <td>{{$feed->id}}</td>
                                  <td>{{$feed->url}}</td>
                                  <td>{{$feed->description}}</td>
                                  <td width="25%">
                                      <button class="btn btn-warning btn-detail open_modal" value="{{$feed->id}}">Edit</button>
                                      <button class="btn btn-danger btn-delete delete-feed" value="{{$feed->id}}">Delete</button>
                                  </td>
                              </tr>
                            @endforeach
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>

        <!-- Passing BASE URL to AJAX -->
        <input id="url" type="hidden" value="{{ \Request::url() }}">

        <!-- MODAL SECTION -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Feed Form</h4>
              </div>
              <div class="modal-body">
                <form id="frmFeeds" name="frmFeeds" class="form-horizontal" novalidate="">
                  <div class="form-group error">
                    <label for="inputName" class="col-sm-3 control-label">URL</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control has-error" id="feed_url" name="url" placeholder="Feed URL" value="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputDetail" class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="description" name="description" placeholder="description" value="">
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-save" value="add">Save Changes</button>
                <input type="hidden" id="feed_id" name="feed_id" value="0">
              </div>
            </div>
          </div>
        </div>
    </body>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{{asset('js/feed.js')}}"></script>
</html>
