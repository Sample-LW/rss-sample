$(document).ready(function(){

    //get base URL *********************
    var baseUrl = $('#url').val();

    //display modal form for creating new feed *********************
    $('#btn_add').click(function(){
        $('#btn-save').val("add");
        $('#frmFeeds').trigger("reset");
        $('#myModal').modal('show');
    });

    //display modal form for feed EDIT ***************************
    $(document).on('click','.open_modal',function(){
        var feed_id = $(this).val();
       
        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: baseUrl + '/' + feed_id,
            success: function (data) {
                console.log(data);
                $('#feed_id').val(data.id);
                $('#feed_url').val(data.url);
                $('#description').val(data.description);
                $('#btn-save').val("update");
                $('#myModal').modal('show');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    //create new feed / update existing feed ***************************
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault(); 
        var formData = {
            'url': $('#feed_url').val(),
            description: $('#description').val(),
        }

        var state = $('#btn-save').val();
        var type = "POST"; //for creating new resource
        var feed_id = $('#feed_id').val();
        var my_url = baseUrl;
        if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + feed_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var feed = '<tr id="feed' + data.id + '"><td>' + data.id + '</td><td>' + data.url + '</td><td>' + data.description + '</td>';
                feed += '<td><button class="btn btn-warning btn-detail open_modal" value="' + data.id + '">Edit</button>';
                feed += ' <button class="btn btn-danger btn-delete delete-feed" value="' + data.id + '">Delete</button></td></tr>';
                if (state == "add"){ //if user added a new record
                    $('#feeds-list').append(feed);
                }else{ //if user updated an existing record
                    $("#feed" + feed_id).replaceWith( feed );
                }
                $('#frmFeeds').trigger("reset");
                $('#myModal').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });


    //delete feed and remove it from TABLE list ***************************
    $(document).on('click','.delete-feed',function(){
        var feed_id = $(this).val();
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        $.ajax({
            type: "DELETE",
            url: baseUrl + '/' + feed_id,
            success: function (data) {
                console.log(data);
                $("#feed" + feed_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    
});
