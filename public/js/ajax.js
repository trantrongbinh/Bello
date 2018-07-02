$(document).ready(function() {

    function createActivity(activity_in_id, changed_in, activity_description) {
        $.ajax({
            url: 'create-user-activity',
            type: 'POST',
            // contentType: "application/json; charset=utf-8",
            dataType: 'json',
            data: {
                activity_in_id: activity_in_id, 
                changed_in: changed_in, 
                activity_description: activity_description
            }, 
            success: function (data) {
                console.log("data")
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    $(function() {
        $('#save-board').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
            $.ajax({
                url: 'postBoard',
                type: 'POST',
                dataType: 'json',
                data: {
                    boardTitle: $('#boardTitle').val(),
                    boardPrivacyType: $('#boardPrivacyType').val() 
                },
                success: function (data) {
                    console.log('thanh cong');
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
                    createActivity(data.id, 'board', 'created a board');
                },
                error: function (error) {
                    console.log('loi');
                    var response = JSON.parse(error.responseText);
                    $('#boardTitleCon').find('.help-block').remove();
                    $.each(response, function(index, val) {
                        $('#boardTitleCon').addClass('has-error');
                        $('#boardTitleCon').append('<span class="help-block"><strong>'+ val +'</strong></span>');
                    });
                }
            }); 
        });
    });

    $(".board-link").hover(function() {
        $(this).find("#make-fv-board").slideDown("fast");
    }, function() {
        $(this).find("#make-fv-board").slideUp("fast");
    });

    function updateBoardFavourite(boardId, isFavourite) {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        $.ajax({
            url: 'update-board-favourite',
            type: 'POST',
            dataType: 'json',
            data: {
                boardId: boardId,
                isFavourite: isFavourite
            },
            success: function (data) {
                console.log(data);
            },
            error: function (error) {
                console.log(error); 
            }
        });
    }

    $(document).on('click', '#make-fv-board', function(event) {
        event.preventDefault();
        event.stopPropagation();

        var starColor = $(this).css('color');
        var boardId = $(this).closest('.board-link').attr("data-boardid");
        var isFavourite;
        if (starColor == "rgb(255, 255, 255)") {
            isFavourite = 1;
            $(this).css('color', "#FFEB3B");
            $(this).closest('.board-link').css('background-color', '#0D0FC6');
            var boardCon = $(this).closest('.col-lg-3').clone();
            var boardTitle = $(boardCon).find("h2").text().trim();
            if ($(".my-fv-board").find('h1.board-starred-heading').length == 0) {
                $(".my-fv-board").prepend('<h1 class="board-starred-heading" style="margin-top: 10px;margin-left: 15px;font-weight: 500;font-size: 25px;"><span class="glyphicon glyphicon-star-empty starred-boards" aria-hidden="true"></span> Starred Boards</h1>');
            };                   

            if ($(".my-fv-board").find(".boards-col .col-lg-3").length == 0 ) {
                $(".my-fv-board").css('display', 'block');
            }
            $(boardCon).find(".col-lg-2").remove();
            $(".my-fv-board").find(".boards-col").prepend(boardCon);
            $("ul.stared-board-list-con").prepend(
                '<li style="margin-bottom: 5px;" data-boardid="'+boardId+'">'+
                    '<a href="http://localhost:8000/board/'+boardId+'" style="color: #393333; padding-left: 0px; line-height: 20px; height: 20px; mar">'+boardTitle+'</a>'+
                '</li>'
            );
            createActivity(boardId, 'board', 'fav a board');
        } else {
            $(this).css('color', "#FFF");
            isFavourite = 0;
            $(".my-fv-board").find(".boards-col .col-lg-3").filter("[data-boardid="+boardId+"]").remove();
            if ($(".my-fv-board").find(".boards-col .col-lg-3").length == 0 ) {
                $(".my-fv-board").css('display', 'none');
            };
            $("ul.stared-board-list-con").find("li").filter("[data-boardid="+boardId+"]").remove();
            createActivity(boardId, 'board', 'un-fav a board');
        }
        updateBoardFavourite(boardId, isFavourite);
    }); 
    
});