<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Weather managment</title>
  <style type="text/css">


.progress {
    display: inline-block;
    width: 100px;
    border: 3px groove #CCC;
}

.progress div {
    font-size: smaller;
    background: orange;
    width: 0;
}
  </style>


</head>


<body ng-app="fileUpload" ng-controller="MyCtrl">
  <a href="<?php echo site_url('imageupload/show_all_images'); ?>">View all Images</a>
  <center>
  <form name="myForm">
    <fieldset>
      <legend>Upload on form submit</legend>
      Image  Label:
      <input type="text" name="userName" ng-model="username" size="31" required>
      <i ng-show="myForm.userName.$error.required">*Image  Label</i>
      <br>Photo:
      <input type="file" ngf-select ng-model="picFile" name="file"    
             accept="image/*" ngf-max-size="2MB" required
             ngf-model-invalid="errorFiles">
      <i ng-show="myForm.file.$error.required">*required</i><br>
      <i ng-show="myForm.file.$error.maxSize">File too large 
          {{errorFiles[0].size / 1000000|number:1}}MB: max 2M</i>
      <img ng-show="myForm.file.$valid" width="200" height="200" ngf-thumbnail="picFile" class="thumb"> <button ng-click="picFile = null" ng-show="picFile">Remove</button>
      <br>
      <button ng-disabled="!myForm.$valid" 
              ng-click="uploadPic(picFile)">Submit</button><br>
      Progress:<span class="progress" ng-show="picFile.progress >= 0">
        <div style="width:{{picFile.progress}}%" 
            ng-bind="picFile.progress + '%'"></div>
      </span>
      <br>
      <span ng-show="picFile.result">Upload Successful</span>
      <span class="err" ng-show="errorMsg">{{errorMsg}}</span>
    </fieldset>
    <br>
  </form>
</center>
</body>

<script src="<?php echo base_url(); ?>js/angular.js"></script>  
<script src="<?php echo base_url(); ?>js/ng-file-upload-shim.js"></script> 
<script src="<?php echo base_url(); ?>js/ng-file-upload.js"></script> 
<script type="text/javascript">
var app = angular.module('fileUpload', ['ngFileUpload']);

app.controller('MyCtrl', ['$scope', 'Upload', '$timeout', function ($scope, Upload, $timeout) {
    $scope.uploadPic = function(file) {
    file.upload = Upload.upload({
      url: "<?php echo site_url('imageupload/save_image') ?>",
      data: {file: file, username: $scope.username},
    });

    file.upload.then(function (response) {
      console.log(response);
      if(response!="success")
      {
       $scope.errorMsg = response.data; 

      }
      else
      {

      $timeout(function () {
        file.result = response.data;
      });

      }

    }, 
    function (response) {
      console.log(response);
      if (response.status > 0)
        $scope.errorMsg = response.data;
    }, 
    function (evt) {
      // Math.min is to fix IE which reports 200% sometimes
      file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
    }

    );
    }
}]);


</script>

</html>

