<?php

function handleXml($content)
{
    $xml = new DOMDocument('1.0', 'UTF-8');
    $xml->loadXML($content, LIBXML_NSCLEAN);
    $cells = $xml->getElementsByTagName('table-cell');

    $cells = iterator_to_array($cells);
    $cells = array_map(function ($cell) {
        $childNodes = $cell->firstChild->childNodes;
        if ($childNodes->length > 1) {
            return $childNodes[1]->nodeValue;
        }
        return $cell->nodeValue;
    }, $cells);
    $cells = array_chunk($cells, 3);

    return $cells;
}

function extractDoc($plik)
{
    $filename = __DIR__ . "/$plik";
    $zip = new ZipArchive();
    if ($zip->open($filename)) {
        $contentFile = $zip->getFromName('content.xml');
        $zip->close();
        if ($contentFile) {
            return handleXml($contentFile);
        }
    }
    return false;
}

$cells = extractDoc('30-zadanie.odt');
$keys = array_column($cells, 0);
$values = array_column($cells, 1);
$x = array_combine($keys, $values);
foreach ($x as $y => $z) {
    echo "<pre>$y: $z</pre>";
}
