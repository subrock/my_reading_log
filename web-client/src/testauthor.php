<?

 // Database connection information.
        $db_host="localhost";
        $db_user="root";
        $db_password="testme";
        $db_name="MY_READING_LOG";

        $reader_id="1";
        $column="entry_author";

        $query="select * from EntryTable where entry_reader_id=".$reader_id." ORDER BY entry_id DESC LIMIT 1";
        $result=mysql_query($query);
        $lstAuthor=mysql_result($result,0,"entry_author");


