

function load() {
window.scrollTo(0, document.body.scrollHeight);
}

        $(document).ready(function() {
                $("#testdiv").delay(5000).fadeOut();
        });


function show(target){
document.getElementById(target).style.display = 'block';
document.getElementById("clickMeId").style.display = 'none';
}
function hide(target){
document.getElementById(target).style.display = 'none';
document.getElementById("clickMeId").style.display = 'block';
}


function addRowHandlers() {
    var table = document.getElementById("display_table");
    var rows = table.getElementsByTagName("tr");
    for (i = 0; i < rows.length; i++) {
        var currentRow = table.rows[i];
        var createClickHandler = 
            function(row) 
            {
                return function() { 
                                        var cell = row.getElementsByTagName("td")[0];
                                        var id = cell.innerHTML;
                                        alert("id:" + id);
                                 };
            };

        currentRow.onclick = createClickHandler(currentRow);
    }
}
window.onload = addRowHandlers();
