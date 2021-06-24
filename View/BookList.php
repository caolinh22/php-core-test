<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Book List</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
    <body>
    <div class="container">
    	<h1>Quản lý môn học</h1>
    	<a href="create.php" class="btn btn-primary">Thêm mới</a>
    	
    	<div class='bg-success text-bold text-center' id="message">
    		<?php 
        	if(isset($_GET["message"])){
        	    $mess = $_GET["message"];
        	    if ($mess == "insert"){
        	       echo "Thêm mới thành công";
        	    } else if ($mess == "update"){
        	        echo "Cập nhật thành công";
        	    } 
        	}
        	?>
    	</div>
    	<table id="tbl" class='table table-border'>
    		<thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Mã môn</th>
                  <th scope="col">Tên môn</th>
                  <th scope="col">Chuyên ngành</th>
                  <th scope="col">Thi</th>
                  <th scope="col">Môn học liên quan</th>
                  <th scope="col">Thao tác</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
    	</table>
    	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	<script type="text/javascript">
		getData();
		function deleteRec(id){
			if (confirm("Bạn có chắc chắn muốn xóa hay không?")){
    			$.ajax({
    				url: "ajaxmonhoc.php",
    				method: "post",
    				data: {
    					"action" : "delete",
    					"id" : id
    				}, 
    				success: function(result){
    					if(result.indexOf("success") > -1){
    						//window.location.href = "index.php?message=delete";
    						getData();
    						$("#message").html("Xóa thành công");
    					} else {
    						$("#message").html("Xóa thất bại");
    					}
    				}
    			});
			}
		}
		
		function getData(){
			$.ajax({
				url: "ajaxmonhoc.php?action=getdata",
				method: "get",
				success: function(result){
					$("#tbl tbody").html(result);
				}
			});
		}
	
	</script>
    </div>
    </body>
</html>