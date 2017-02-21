$(document).ready(function(){
   $('#like').click(function(){
      data=$("#like").attr("value");
      url=$("#like").attr("url");
        $.ajax({
        url: url,
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
   $('#searchForm').on('submit',function(e){
       search_word=$('input[name=search]').val();
       if(search_word==''){
         return false;
       }
       
   });
});

$(document).ready(function(){
$('#comment').on('submit',function(e){
    token = $('input[name=_token]').val();
    url=$(this).attr('action');
    comment=$('input[name=comment]').val();
    if(comment==''){
      return false;
    }
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
            $('#total-comments commmentCount').html(+resp.total_comments);
             $(".comments-box").append(''+
                '<div class="col-md-8 col-md-offset-2 clear comment_row" comment-id="'+resp.comment_id+'">'+
                  '<div class="for-edit"></div>'+
                  '<div class="for-view">'+
                    '<div class="pull-left">'+
                      '<p><strong>'+resp.name+'</strong> <comment-section>'+resp.content+'</comment-section></p>'+
                    '</div>'+
                    '<div class="pull-right actionDiv">'+
                      '<p class="action" action-comment-id="'+resp.comment_id+'" onmouseleave="actionMenuHide()" onmouseenter="actionMenuShow(this)" token="'+resp.token+'" url="'+resp.action_url+'">....</p>'+
                    '</div>'+
                  '</div>'+
                '</div>');
            //$(".comment-box").append("<p><strong>"+resp.name+"</strong>"+"  "+resp.content+"</p>");
            $('#comment-input').val(' ');
          }

        }
    });
    return false;
});
});

function commentEditCancel(){

  $('.for-edit').html('');
  $('.for-view').fadeIn();
}
function commentEditAction(token,url,event,thisEle){
  //tommorrow
  if(event.which==13 && !event.shiftKey){
     //alert(thisEle.value);
       $.ajax({
        url: url,
        headers: {'X-CSRF-TOKEN': token},
        data: {comment:$.trim(thisEle.value)},
        type: 'PUT',
        datatype: 'JSON',
        beforeSend:function(){

        },
        success: function (resp) {
            $('.for-edit').html('');
            $('[comment-id='+resp.id+'] .for-view div comment-section').html($.trim(thisEle.value));
            $('.for-view').fadeIn();
        }
  });
  }
}
function commentEdit(token,url,action_comment_id) {
  $('.for-edit').html('');
  $('.for-view').fadeIn();
  var content=$('[comment-id='+action_comment_id+'] .for-view div comment-section').html();
  $('[comment-id='+action_comment_id+'] .for-view').fadeOut();
  $('[comment-id='+action_comment_id+'] .for-edit').html(''+
     '<div class="col-xs-12 form-group" id="comment-input-div">'+
            /*'<input type="text" class="form-control input-lg" id="comment-input" name="comment" placeholder="Write comment here.. " value="'+content+'">'+*/
            '<textarea class="form-control" onkeypress=\'commentEditAction("'+token+'","'+url+'",event,this)\'>'+content+'</textarea>'+
            '<button onclick="commentEditCancel()">cancel</button>'+
          '</div>');

  return false;
  $.ajax({
         url: url,
        headers: {'X-CSRF-TOKEN': token},
        data: {comment:comment,post_id:post_id},
        type: 'PUT',
        datatype: 'JSON',
        beforeSend:function(){

        },
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
}
function commentDelete(token,url,commentTotal) {
  $.ajax({
         url: url,
        headers: {'X-CSRF-TOKEN': token},
        data: {},
        type: 'DELETE',
        beforeSend:function(){

        },
        success: function (resp) {
          $('[comment-id='+resp.id+']').fadeOut();
        }
  }).fail(function(){

  }).done(function(res){
      $('#total-comments commmentCount').html(--commentTotal);
  });
}
function actionMenuShow(event){
  var commentTotal=$('#total-comments commmentCount').html();
  var action_comment_id=$(event).attr('action-comment-id');
  var token=$(event).attr('token');
  var url=$(event).attr('url');
  $(event).append(""+
    "<div class='actionType'>"+
      '<div id="triangle-up"></div>'+
        '<ul>'+
          '<li onclick=\'commentEdit("'+token+'","'+url+'","'+action_comment_id+'")\'>Edit</li>'+
          '<li onclick=\'commentDelete("'+token+'","'+url+'","'+commentTotal+'")\'>Delete</li>'+
        '</ul>'+
    "</div>");
}
function postDelete(token,url,redirect) {
  $.ajax({
        url: url,
        headers: {'X-CSRF-TOKEN': token},
        data: {},
        type: 'DELETE',
        beforeSend:function(){

        },
        success: function (resp) {
          alert("Your post has been deleted");
          window.location.replace(redirect);
        }
  });
}
function actionMenuShowPost(event){
  var action_post_id=$(event).attr('action-post-id');
  var token=$(event).attr('token');
  var url=$(event).attr('url');
  var edit_url=$(event).attr('edit-url');
  var redirect=$(event).attr('redirect');
  $(event).append(""+
    "<div class='actionType pull-right'>"+
      '<div id="triangle-up"></div>'+
        '<ul>'+
          '<li><a href="'+edit_url+'">Edit</a></li>'+
          '<li onclick=\'postDelete("'+token+'","'+url+'","'+redirect+'")\'>Delete</li>'+
        '</ul>'+
    "</div>");
}
/*$('.action--').hover(function(event){
  var commentTotal=$('#total-comments commmentCount').html();
  
  var token=$(this).attr('token');
  var url=$(this).attr('url');
  $(this).append(""+
    "<div class='actionType'>"+
      '<div id="triangle-up"></div>'+
        '<ul>'+
          '<li onclick=\'commentEdit("'+token+'","'+url+'")\'>Edit</li>'+
          '<li onclick=\'commentDelete("'+token+'","'+url+'","'+commentTotal+'")\'>Delete</li>'+
        '</ul>'+
    "</div>");
});*/
function actionMenuHide(){

    $('.actionType').remove();
}
$('.action').mouseleave(function(){
  });

/*<div class="actionType">
              <div id="triangle-up"></div>
              <ul>
                <li>Edit</li>
                <li>Delete</li>
              </ul>
            </div>*/