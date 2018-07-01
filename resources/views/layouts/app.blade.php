<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dingo</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-editable.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/magic-check.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/selectize.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/animation.css') }}" rel="stylesheet"/>
    <script>
        var assetUserImage = "{{ asset('img/user_1.jpg') }}";
    </script>
</head>
<body>
    <div class="spinner">
      <div class="rect1"></div>
      <div class="rect2"></div>
      <div class="rect3"></div>
      <div class="rect4"></div>
      <div class="rect5"></div>
    </div>
    @include('layouts.partials.modal')
    @include('layouts.partials.navigation')
    @yield('content')

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/bootstrap-editable.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('js/ajax-loading.js') }}"></script>
    <script src="{{ asset('js/selectize.js') }}"></script>
    <script src="{{ asset('js/board.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="{{ asset('js/typed.min.js') }}"></script>
    <script>
         function saveBoard () {
            $.ajax({
                url: 'postBoard',
                type: 'POST',
                contentType: "application/json; charset=utf-8",
                dataType: 'json',
                data: {
                    boardTitle: $('#boardTitle').val(),
                    boardPrivacyType: $('#boardPrivacyType').val() 
                },
                success: function (data) {
                    $('.board-create-link').closest(".col-lg-3").before(
                        '<div class="col-lg-3">'+
                            '<div class="board-link" style="cursor: pointer;" data-boardid="'+data.id+'">'+
                                '<div class="row">'+
                                    '<div class="col-lg-10">'+
                                        '<h2 style="margin-top: 5px;">'+
                                            '<a href="http://localhost:8000/board?id='+data.id+'" class="board-main-link-con" style="font-size: 20px; color: #FFF;">'+
                                                data.boardTitle +
                                            '</a>'+
                                        '</h2>'+
                                    '</div>'+
                                    '<div class="col-lg-2">'+
                                        '<p style="margin-top: 12px;">'+
                                            '<a href="#" style="font-size: 20px; color: #FFF;" id="make-fv-board"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></a>'+
                                        '</p>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                    );
                    $('#create-new-board').modal('hide') 
                    $('#boardTitle').val('');
                    $('#boardTitleCon').removeClass('has-error');
                    $('#boardTitleCon').find('.help-block').remove();
                    this.createActivity(data.id, 'board', 'created a board');
                },
                error: function (error) {
                    var response = JSON.parse(error.responseText);
                    $('#boardTitleCon').find('.help-block').remove();
                    $.each(response, function(index, val) {
                        $('#boardTitleCon').addClass('has-error');
                        $('#boardTitleCon').append('<span class="help-block"><strong>'+ val +'</strong></span>');
                    });
                }
            }); 
        }
    </script>
</body>
</html>
