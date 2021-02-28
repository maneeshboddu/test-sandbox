

<?php include('insert.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>maneesh boddu</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="wrapper">
    <?php echo $comments; ?>
    <form class="comment_form">
      <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name">
      </div>
      <button type="button" id="submit_btn">POST</button>
      <button type="button" id="update_btn" style="display: none;">UPDATE</button>
    </form>
  </div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>
$(document).ready(function(){
  // save comment to database
  $(document).on('click', '#submit_btn', function(){
    var name = $('#name').val();
    $.ajax({
      url: 'server.php',
      type: 'POST',
      data: {
        'save': 1,
        'name': name,
      },
      success: function(response){
        $('#name').val('');
        $('#display_area').append(response);
      }
    });
  });
  // delete from database
  $(document).on('click', '.delete', function(){
    var id = $(this).data('id');
    $clicked_btn = $(this);
    $.ajax({
      url: 'server.php',
      type: 'GET',
      data: {
      'delete': 1,
      'id': id,
      },
      success: function(response){
        // remove the deleted comment
        $clicked_btn.parent().remove();
        $('#name').val('');
      }
    });
  });

  var edit_id;
  var $edit_comment;
  $(document).on('click', '.edit', function(){
    edit_id = $(this).data('id');
    $edit_comment = $(this).parent();
    // grab the comment to be editted
    var name = $(this).siblings('.display_name').text();
   // var comment = $(this).siblings('.comment_text').text();
    // place comment in form
    $('#name').val(name);
    //$('#comment').val(comment);
    $('#submit_btn').hide();
    $('#update_btn').show();
  });
  $(document).on('click', '#update_btn', function(){
    var id = edit_id;
    var name = $('#name').val();
   // var comment = $('#comment').val();
    $.ajax({
      url: 'server.php',
      type: 'POST',
      data: {
        'update': 1,
        'id': id,
        'name': name,
        //'comment': comment,
      },
      success: function(response){
        $('#name').val('');
      //  $('#comment').val('');
        $('#submit_btn').show();
        $('#update_btn').hide();
        $edit_comment.replaceWith(response);
      }
    });   
  });
});
</script>