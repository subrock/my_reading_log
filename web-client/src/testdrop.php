<!DOCTYPE html>
<html>
<head>
<script type='text/javascript'
  src='http://code.jquery.com/jquery-2.0.2.js'></script>
<link rel="stylesheet" type="text/css"
  href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
<script type='text/javascript'
  src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css"
  href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css">
<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
//save the selector so you don't have to do the lookup everytime
$dropdown = $("#contextMenu");
$(".actionButton").click(function() {
    //get row ID
    var id = $(this).closest("tr").children().first().html();
    //move dropdown menu
    $(this).after($dropdown);
    //update links
    $dropdown.find(".payLink").attr("href", "/transaction/pay?id="+id);
    $dropdown.find(".delLink").attr("href", "/transaction/delete?id="+id);
    //show dropdown
    $(this).dropdown();
});
});//]]>  
</script>
</head>
<body>
  <table id="myTable" class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>Mark</td>
        <td>Otto</td>
        <td class="dropdown"><a class="btn btn-default actionButton"
          data-toggle="dropdown" href="#"> Action </a></td>
      </tr>
      <tr>
        <td>2</td>
        <td>Jacob</td>
        <td>Thornton</td>
        <td class="dropdown"><a class="btn btn-default actionButton"
          data-toggle="dropdown" href="#"> Action </a></td>
      </tr>
      <tr>
        <td>3</td>
        <td>Larry</td>
        <td>the Bird</td>
        <td class="dropdown"><a class="btn btn-default actionButton"
          data-toggle="dropdown" href="#"> Action </a></td>
      </tr>
    </tbody>
  </table>
  <ul id="contextMenu" class="dropdown-menu" role="menu">
    <li><a tabindex="-1" href="#" class="editLink">Edit Row</a></li>
    <li><a tabindex="-1" href="#" class="delLink">Delete Row</a></li>
  </ul>
</body>
</html>
