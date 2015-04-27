$(document).ready(function ()
{
    $("#form_submit").click(function()
    {
        $("#target_form").submit();
    });

    $("#category_submit").click(function()
    {
        $("#category_form").submit();
    });

    $("#thread_submit").click(function()
    {
        $("#thread_form").submit();
    });

    $(".new_category").click(function()
    {
        var id = $(this).attr('id');
        var pieces = id.split("-");
        $("#category_form").prop('action', mainURL + '/forum/category/' + pieces[2] + '/new');
    });

    $(".edit_thread").click(function()
    {
        $("#thread_form").prop('action', mainURL + '/forum/thread/' + $(this).attr('data-thread-id') + '/edit');
    });

    $(".delete_group").click(function(event)
    {
        $("#btn_delete_group").prop('href', mainURL + '/forum/group/' + event.target.id + '/delete');
    });

    $(".delete_category").click(function(event)
    {
        $("#btn_delete_category").prop('href', mainURL + '/forum/category/' + event.target.id + '/delete');
    });

    $(".delete_tag").click(function(event)
    {
        $("#btn_delete_tag").prop('href', mainURL + '/forum/tag/' + event.target.id + '/delete');
    });

    $(".edit-comment").click(function(event)
    {
        $text = $(this).siblings('.comment-content');
        $text.replaceWith('<textarea class="form-control comment-content">' + $text.text().trim() + '</textarea>').focus();
        $(this).css('display', 'none');
        $(this).siblings('.cancel-edit-comment').css('display', 'inline-block');
        $(this).siblings('.send-edited-comment').css('display', 'inline-block');
    });

    $(".cancel-edit-comment").click(function(event)
    {
        $text = $(this).siblings('.comment-content');
        $text.replaceWith('<p class="comment-content">' + $text.text().trim() + '</p>');
        $(this).css('display', 'none');
        $(this).siblings('.edit-comment').css('display', 'inline-block');
        $(this).siblings('.send-edited-comment').css('display', 'none');
    });

    $(".send-edited-comment").click(function(event)
    {
        $commentID = $(this).attr('data-comment-id');
        $el = $(this);
        $data = $(this).siblings('.comment-content').val().trim();
        $.ajax({
            url: mainURL + '/forum/comment/' + $commentID + '/edit',
            method: 'post',
            data: {body: $data}
        }).done(function( data, textStatus, jqXHR ) {
            if (data == 1) {
                $text = $($el).siblings('.comment-content');
                $text.replaceWith('<p class="comment-content">' + $text.val().trim() + '</p>');
                $($el).css('display', 'none');
                $($el).siblings('.edit-comment').css('display', 'inline-block');
                $($el).siblings('.cancel-edit-comment').css('display', 'none');
                $alert = $($el).siblings('.success-alert');
            } else {
                $alert = $($el).siblings('.error-alert');
            }

            $($alert).alert();
            $($alert).fadeTo(2000, 500).slideUp(500, function(){
                $($alert).hide();
            });
        })
    });

    $(document).on('click', ".remove-tag", function(event)
    {
        $el = $(this);
        $threadtID = $el.attr('data-thread-id');
        $tagName = $el.attr('data-tag-name');
        $.ajax({
            url: mainURL + '/forum/thread/' + $threadtID + '/tag/' + $tagName + '/delete',
            method: 'get'
        }).done(function( data, textStatus, jqXHR ) {
            if (data == 1) {
                $el.parent('.tag').remove();
            }
        })
    });

    $(document).on('click', ".add-tag", function(event)
    {
        $(this).siblings('.save-tag').css('display', 'inline-block');
        $(this).siblings('.new-tag-name').css('display', 'inline-block').focus();
    });

    $(".save-tag").click(function(event)
    {
        $el = $(this);
        $threadtID = $($el).attr('data-thread-id');
        $tagName = $($el).siblings('.new-tag-name').val().trim();console.log($threadtID);
        $.ajax({
            url: mainURL + '/forum/thread/' + $threadtID + '/tag/' + $tagName + '/add',
            method: 'get'
        }).done(function( data, textStatus, jqXHR ) {
            if (data == 1) {
                $($el).css('display', 'none');
                $($el).siblings('.new-tag-name').css('display', 'none');
                $($el).siblings('.new-tag-name').val('');
                $newElem = '<div class="tag hvr-back-pulse tag"><a href="' + mainURL + '/forum/tag/' + $tagName + '">' + $tagName + '</a><button class="btn-xs btn-danger remove-tag" data-tag-name="' + $tagName + '" data-thread-id="' + $threadtID + '" title="Remove this Tag">X</button></div>';
                $($el).siblings('.new-tag-name').before($newElem);
            }
        })
    });


});