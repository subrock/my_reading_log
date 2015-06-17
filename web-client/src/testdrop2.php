<!DOCTYPE html>
<html>
<head>
<style>
#contextMenu {
  position: absolute;
  display:none;
}
div {
	background-color: silver
}
</style>

  <script src="http://code.jquery.com/jquery.min.js"></script>
<script>
$(function() {
  
  var $contextMenu = $("#contextMenu");
  
  $("body").on("contextmenu", "table tr", function(e) {
    $contextMenu.css({
      display: "block",
      left: e.pageX,
      top: e.pageY
    });
    return false;
  });
  
  $contextMenu.on("click", "a", function() {
     $contextMenu.hide();
  });
  
});

$("body").click
(
  function(e)
  {
    if(e.target.className !== "contextMenu")
    {
     $contextMenu.hide();
    }
  }
);
</script>
<meta charset=utf-8 />
<title>JS Bin</title>
</head>
<body>

  <table id="mt" class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Username</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
      </tr>
      <tr>
        <td>2</td>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
      </tr>
      <tr>
        <td>3</td>
        <td>Larry</td>
        <td>the Bird</td>
        <td>@twitter</td>
      </tr>
    </tbody>
  </table>
  
  <div id="contextMenu" class="dropdown clearfix">
    <div class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block;position:static;margin-bottom:5px;">
      <a tabindex="-1" href="#">Action</a><Br>
      <a tabindex="-1" href="#">Another action</a><Br>
      <a tabindex="-1" href="#">Something else here</a><Br>
      <a tabindex="-1" href="#">Separated link</a>
    </div>
  </div>
  
</body>
</html>
