<?php
// root
DEFINE ("ARHIVA"    , ROOT . "/arhiva");
DEFINE ("RESOURCES" , ROOT . "/resources");
DEFINE ("LIB"       , ROOT ."/lib");

// resources
DEFINE ("DB_FILE"   , RESOURCES . "/db/arhiva_reviste_v4.1.db");
DEFINE ("TEMPL"     , RESOURCES ."/templates");
DEFINE ("IMG"       , RESOURCES ."/img");

$db = new SQLite3(DB_FILE, SQLITE3_OPEN_READONLY) or die;