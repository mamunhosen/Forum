$(document).ready(function(){
   $('#like').click(function(){
      data=$("#like").attr("value");
        $.ajax({
        url: '/Forum/like',
        data: {'post_id':data},
        type: 'GET',
        datatype: 'JSON',
        success: function (resp) {
          if (resp.message=='success') {
            $("#like").html(' '+resp.like);
          }
          else{
            alert('You already Liked it');
          }
        }
    });
   });
});

$(function(){
$('#comment').on('submit',function(e){
    token = $('input[name=_token]').val();
    url=$(this).attr('action');
    comment=$('input[name=comment]').val();
    post_id=$('input[name=post_id]').val();
    $.ajax({
        url: url,
        headers: {'X-CSRF-TOKEN': token},
        data: {comment:comment,post_id:post_id},
        type: 'POST',
        datatype: 'JSON',
        success: function (resp) {
          if (resp.message.comment) {
             alert('The comment is required!');
          }
          else{
            $("#total-comments").html(' '+resp.total_comments);
            $(".comment-box").append("<p><strong>"+resp.name+"</strong>"+"  "+resp.content+"</p>");
            $('#comment-input').val(' ');
          }

        }
    });
    return false;
});
});
