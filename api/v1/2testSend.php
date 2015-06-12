
<?
function array_sort_by_column(&$array, $column, $direction = SORT_ASC) {
    $reference_array = array();

    foreach($array as $key => $row) {
        $reference_array[$key] = $row[$column];
    }

    array_multisort($reference_array, $direction, $array);
}

$books = array();

$xml = simplexml_load_file('books.xml'); 

foreach($xml->items->item as $item) {
    $books[] = array(
                     'id'             => (string)$item->attributes()->id,
                     'title'          => (string)$item->title,
                     'isbn'           => (string)$item->isbn,
                     'course'         => (string)$item->courses->course[0],
                     'borrowed_count' => intval($item->borrowedcount)
                    );
}


array_sort_by_column($books, 'borrowed_count');

var_dump($books);
?>
