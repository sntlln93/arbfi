<?php

function generatePDF($players){
	$client = new \Pdfcrowd\HtmlToPdfClient("msantillan", "3eaab846081dd065482c355dce3ab02c");
	
	$view = view('carnets')->with('players', $players)->render();
	$client->setPageSize("A4");
	$client->setPageMargins("10mm", "15mm", "15mm", "15mm");
	$pdf = $client->convertString($view);
	header("Content-Type: application/pdf");
    header("Cache-Control: no-cache");
    header("Accept-Ranges: none");
    header("Content-Disposition: inline; filename=\"example.pdf\"");

    echo $pdf;
}