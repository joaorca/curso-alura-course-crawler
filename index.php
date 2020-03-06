<?php

include 'vendor/autoload.php';

use \Symfony\Component\DomCrawler\Crawler;

$url = 'https://cursos.alura.com.br';

$client = new \GuzzleHttp\Client( ['base_uri'=>$url] );

$response = $client->request( 'GET', '/courses' );

$html = $response->getBody();

$crawler = new Crawler();
$crawler->addHtmlContent( $html );

$elementos = $crawler->filter( ' span.course-card__name' );

foreach ( $elementos as $elemento ) {
    $link = $elemento->parentNode->parentNode->parentNode->childNodes[1]->attributes[4]->textContent;
    echo $elemento->textContent. ' ['.$url.$link.']' . PHP_EOL;
}