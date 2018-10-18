$(document).ready(function() {
    $('select[name="feed"]').on('change', function() {
    var feedID = $(this).val();
    if (feedID) {
        $.ajax({
        url: '/news-feed/ajax/'+feedID,
        type: "GET",
        dataType: "html",
        success:function(data) {
            console.log(data);
            // $("#rssOutput").empty();
            // TODO append/draw HTML on frontend side so dataType should be json.
            $("#rssOutput").html(data);
        }
        });
    } else {
      $("#rssOutput").empty();
    }
    });
});
