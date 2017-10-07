<?php

DEFINE("ROOT", "..");
require_once("../resources/config.php");
require_once HELPERS . "/h_tables.php";
require_once HELPERS . "/h_images.php";
require_once HELPERS . "/h_html.php";
require_once HELPERS . "/h_misc.php";

// load classes
require_once DB_DIR. "/DBC.php";
require_once LIB . "/Articol.php";
require_once LIB . "/Editie.php";
use ArhivaRevisteVechi\resources\db\DBC;
use ArhivaRevisteVechi\lib\Articol;

$editieId = $_GET["editie"];


/* --- info editia curenta --- */
include_once "articole_bit_editia_curenta.php";


/* --- info pagina curenta --- */
include_once "articole_bit_pagina_curenta.php";


/* --- cuprins articole --- */
$articoleDbResult = $db->queryArticoleDinEditie($editiaCurenta->editieId);

// TODO delete
$articoleCardRecipe = array(
    "pagina"        => function ($row) {return getColData($row, DBC::ART_PG_TOC);},
    "rubrica"       => function ($row) {return getColData($row, DBC::ART_RUBRICA);},
    "titlu"         => function ($row) {return getColData($row, DBC::ART_TITLU);},
    "autor"         => function ($row) {return getColData($row, DBC::ART_AUTOR);},
    "pagini-count"  => function ($row) {return extractThumbPages(getColData($row, DBC::ART_PG_TOC),
                                                                  getColData($row, DBC::ART_PG_CNT));}
    );

// TODO delete
//$articoleCardRows = buildCardRows($articoleDbResult, $articoleCardRecipe);

$articoleArray = array();

while ($dbRow = $db->getNextRow($articoleDbResult)) {
    $articol = new Articol($dbRow, $editiaCurenta);
    $articoleArray[] = $articol->getHtmlOutput();
}

$articoleCardRows = buildDivRows($articoleArray, "articol-card-container");


/* --- afisare in pagina --- */
include_once HTMLLIB . "/view_dual.php";


/* --- internals --- */

/**
 * Construieste thumbnails pagini cu linkuri catre imaginea mare
 * Returneaza un string cu html pentru afisare in tabel
 */
function extractThumbPages($startPage, $pageCount) {
    global $editiaCurenta;
    $imgDir = buildImageDir($editiaCurenta->numeRevista,
                            $editiaCurenta->an,
                            $editiaCurenta->luna);

    $pageThumbLinks = "";

    for ($pgIndex = 0; $pgIndex < $pageCount; $pgIndex++) {
        $thisPageNo = $startPage + $pgIndex;
        $imageBaseName = getBaseImageName($editiaCurenta->numeRevista,
                                            $editiaCurenta->an,
                                            $editiaCurenta->luna,
                                            $thisPageNo);
        $imageThumb = getImageThumbPath($imgDir, $imageBaseName);

        $destinationLink = getBaseUrl() . "?editie={$editiaCurenta->editieId}" . "&pagina=$thisPageNo";

        $pageThumbLinks .= getImageWithLink($imageThumb, $destinationLink, "minithumb")."  ";
    }
    return $pageThumbLinks;
}