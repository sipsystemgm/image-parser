<?php

namespace Sip\ImageParser;

use Sip\ImageParser\Interfaces\ImageParserInterface;
use Symfony\Component\DomCrawler\Crawler;

class PregParser extends SymfonyCrawlerParser
{
    protected function parseImage(string $html): void
    {
        $pattern = "/src=[\"']?([^\"']?.*(png|jpg|gif))[\"']?/i";
        if (preg_match_all($pattern, $html, $images) && !empty($images[1])) {
            foreach ($images[1] as $imgLink) {
                if ($this->validateTag('src', $imgLink)) {
                    $this->imgLength ++;
                }
            }
        }
    }
}