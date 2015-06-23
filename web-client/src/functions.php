<?

// Global Functions


// Set Authentication Cookie.`
function setAuthenticationCookie($reader_id) {
	setcookie("MY_READING_LOG","$reader_id");
}

// When was the log started?
function get_first_date($key,$id) {
        include 'settings.php';
        $postdata = http_build_query(
                array(
                        'signiture' => $key,
                        'rid' => $id
                )
        );
        $opts = array('http' =>
                array(
                        'method'  => 'POST',
                        'header'  => 'Content-type: application/x-www-form-urlencoded',
                        'content' => $postdata
                )
        );
        $context = stream_context_create($opts);
        $homepage = file_get_contents($api_url."/GetFirstDate/",false,$context);
        try {
                $sxe = new SimpleXMLElement($homepage);
        } catch (Exception $e) {
                echo "Function get_first_date failed. Probably malformed XML.<Br><Br><pre>$e</pre><Br>$api_url/GetFirstDate/";
                exit;
        }
        $res = $sxe->{"date"};
return $res;

}

// Add up all the total_pages and you get_total_page read.
function total_pages_read($key,$id) {
	include 'settings.php';
	$postdata = http_build_query(
    		array(
        		'signiture' => $key,
        		'rid' => $id
    		)
	);
	$opts = array('http' =>
    		array(
        		'method'  => 'POST',
        		'header'  => 'Content-type: application/x-www-form-urlencoded',
        		'content' => $postdata
    		)	
	);
	$context = stream_context_create($opts);
	$homepage = file_get_contents($api_url."/TotalPagesRead/",false,$context);
	try {
  		$sxe = new SimpleXMLElement($homepage);
	} catch (Exception $e) {
		echo "Function total_pages_read failed. Probably malformed XML.<Br><Br><pre>$e</pre><Br>$api_url/TotalPagesRead/";
  		exit;
	}
        $res = $sxe->{"pages"};
return $res;
}





// Total minutes needed to read a page.
function total_minutes_page($total_minutes_read,$total_pages_read)
{
        $total_minutes_page=($total_minutes_read / $total_pages_read);
        $total_minutes_page=number_format($total_minutes_page, 2, '.', '');
        return $total_minutes_page;
}

//Total of a paticular column.
function total_cols($column,$key,$id) {
        include 'settings.php';
        $postdata = http_build_query(
                array(
                        'signiture' => $key,
                        'column' => $column,
                        'rid' => $id
                )
        );
        $opts = array('http' =>
                array(
                        'method'  => 'POST',
                        'header'  => 'Content-type: application/x-www-form-urlencoded',
                        'content' => $postdata
                )
        );
        $context = stream_context_create($opts);
        $homepage = file_get_contents($api_url."/TotalColumns/",false,$context);
        try {
                $sxe = new SimpleXMLElement($homepage);
        } catch (Exception $e) {
                echo "Function total_cols failed. Probably malformed XML.<Br><Br><pre>$e</pre><Br>$api_url/TotalColumns/";
                exit;
        }
        $res = $sxe->{"records"};
return $res;


}

// Convert house to minutes.
function convertToHoursMins($time, $format = '%d:%d') {
    settype($time, 'integer');
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}

// total minutes read.
function total_minutes_read($key,$id) {
        include 'settings.php';
        $postdata = http_build_query(
                array(
                        'signiture' => $key,
                        'rid' => $id
                )
        );
        $opts = array('http' =>
                array(
                        'method'  => 'POST',
                        'header'  => 'Content-type: application/x-www-form-urlencoded',
                        'content' => $postdata
                )
        );
        $context = stream_context_create($opts);
        $homepage = file_get_contents($api_url."/TotalMinutesRead/",false,$context);
        try {
                $sxe = new SimpleXMLElement($homepage);
        } catch (Exception $e) {
                echo "Function total_minutes_read failed. Probably malformed XML.<Br><Br><pre>$e</pre><Br>$api_url/TotalMinutesRead/";
                exit;
        }
        $res = $sxe->{"minutes"};
return $res;
}

function get_reader_name($key,$id) {
        include 'settings.php';
        $postdata = http_build_query(
                array(
                        'signiture' => $key,
                        'rid' => $id
                )
        );
        $opts = array('http' =>
                array(
                        'method'  => 'POST',
                        'header'  => 'Content-type: application/x-www-form-urlencoded',
                        'content' => $postdata
                )
        );
        $context = stream_context_create($opts);
        $homepage = file_get_contents($api_url."/GetReaderName/",false,$context);
        try {
                $sxe = new SimpleXMLElement($homepage);
        } catch (Exception $e) {
                echo "Function get_reader_name failed. Probably malformed XML.<Br><Br><pre>$e</pre><Br>$api_url/GetReaderName/";
                exit;
        }
        $res = $sxe->{"reader_name"};
return $res;
}

function lastTitle($key,$id) {
        include 'settings.php';
        $postdata = http_build_query(
                array(
                        'signiture' => $key,
                        'rid' => $id
                )
        );
        $opts = array('http' =>
                array(
                        'method'  => 'POST',
                        'header'  => 'Content-type: application/x-www-form-urlencoded',
                        'content' => $postdata
                )
        );
        $context = stream_context_create($opts);
        $homepage = file_get_contents($api_url."/GetLastTitle/",false,$context);
        try {
                $sxe = new SimpleXMLElement($homepage);
        } catch (Exception $e) {
                echo "Function lastTitle failed. Probably malformed XML.<Br><Br><pre>$e</pre><Br>$api_url/GetLastTitle/";
                exit;
        }
        $res = $sxe->{"title"};
return $res;
}

function lastAuthor($key,$id) {
        include 'settings.php';
        $postdata = http_build_query(
                array(
                        'signiture' => $key,
                        'rid' => $id
                )
        );
        $opts = array('http' =>
                array(
                        'method'  => 'POST',
                        'header'  => 'Content-type: application/x-www-form-urlencoded',
                        'content' => $postdata
                )
        );
        $context = stream_context_create($opts);
        $homepage = file_get_contents($api_url."/GetLastAuthor/",false,$context);
        try {
                $sxe = new SimpleXMLElement($homepage);
        } catch (Exception $e) {
                echo "Function lastAuthor failed. Probably malformed XML.<Br><Br><pre>$e</pre><Br>$api_url/GetLastAuthor/";
                exit;
        }
        $res = $sxe->{"author"};
return $res;
}

function array_sort_by_column(&$array, $column, $direction) {
    $reference_array = array();

    foreach($array as $key => $row) {
        $reference_array[$key] = $row[$column];
    }
        if ($direction=="SORT_ASC") {
                array_multisort($reference_array, SORT_ASC, $array);
        } else {
                array_multisort($reference_array, SORT_DESC, $array);
        }
}



?>
