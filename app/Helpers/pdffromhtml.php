<?php

function generatePDF(){
	$client = new \Pdfcrowd\HtmlToPdfClient("msantillan", "3eaab846081dd065482c355dce3ab02c");
	
	$players = App\Player::all();
	$view = view('carnets')->with('players', $players)->render();
	$client->setPageSize("Letter");
	$client->setPageMargins("15mm", "15mm", "15mm", "15mm");
	$pdf = $client->convertString($view);
	header("Content-Type: application/pdf");
    header("Cache-Control: no-cache");
    header("Accept-Ranges: none");
    header("Content-Disposition: inline; filename=\"example.pdf\"");

    echo $pdf;
}