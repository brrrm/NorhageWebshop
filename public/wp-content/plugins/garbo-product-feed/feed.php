<?php

error_log('hhhihih');
$doc = new DomDocument('1.0'); 
$xmlRoot = $doc->createElement("rss");
$xmlRoot = $doc->appendChild($xmlRoot);
$xmlRoot->setAttribute('xmlns:g', 'http://base.google.com/ns/1.0');
$xmlRoot->setAttribute('version', '2.0');

$channelNode = $xmlRoot->appendChild($doc->createElement('channel'));
$channelNode->appendChild($doc->createElement('title', 'lalala'));
$channelNode->appendChild($doc->createElement('link', 'https://nu.nl'));
$channelNode->appendChild($doc->createElement('description', 'oohlalala'));
echo $doc->saveXML();
exit();