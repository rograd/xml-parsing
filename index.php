<?php

function clearAnnotations(DOMDocument $xml): void
{
    $annotations = $xml->getElementsByTagName('annotation');
    foreach ($annotations as $annotation) {
        $annotation->parentNode->removeChild($annotation);
    }
}

function handleXml(string $xml): array
{
    $doc = new DOMDocument('1.0', 'UTF-8');
    $doc->loadXML($xml);

    clearAnnotations($doc);

    $rows = $doc->getElementsByTagName('table-row');
    $rows = iterator_to_array($rows);
    $rows = array_map(function ($row) {
        $cells = $row->childNodes;
        $cells = iterator_to_array($cells);
        $cells = array_map(fn ($cell) => $cell->nodeValue, $cells);

        return $cells;
    }, $rows);

    return $rows;
}

function extractDoc(string $plik)
{
    $filename = __DIR__ . "/$plik";
    $zip = new ZipArchive();
    if ($zip->open($filename)) {
        $content = $zip->getFromName('content.xml');
        $zip->close();
        return $content;
    }
}

$xml = extractDoc('30-zadanie.odt');
if ($xml) {
    $rows = handleXml($xml);
    $data = array_column($rows, 1, 0);
    // $data2 = array_column($rows, 2);
    echo '<pre>';
    print_r($data);
    // print_r($data2);
    echo '</pre>';
}
