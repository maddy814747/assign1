<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Weather managment</title>



</head>


<body ng-app="fileUpload" ng-controller="MyCtrl">
  <a href="<?php echo site_url('imageupload'); ?>">Upload images</a>
  <center>

          <table border="1">
              <tr>
                <td>No images uploaded </td>
              </tr>
              <?php if(empty($all_images)) { ?>
              <tr><td>No images </td></tr>
              <?php } else { $i=1; foreach ($all_images as $ai) { ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $ai->image_label; ?></td>
                <td><img src="<?php echo $ai->image_base64; ?>" width="200" height="200" /></td>
                <td><a class="remove_images">Remove images</a> <input type="hidden" class="image_upload_id" value="<?php echo $ai->image_details_id; ?>" /></td>
              </tr>
              <?php $i++;  }
              } ?>
          </table>
  </center>
</body>

<script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

  $('.remove_images').click(function(event) {

    var image_id = $(this).closest('tr').find('.image_upload_id').val();
    var tr=$(this).closest('tr');

    $.ajax({
                        url: '<?php echo site_url("imageupload/delete_images") ?>',
                        type: 'POST',
                        data: {image_id:image_id},
                        success:function(msg){
                         
                        tr.remove();
                            
                        }
        });



  });


});
</script>
</html>

