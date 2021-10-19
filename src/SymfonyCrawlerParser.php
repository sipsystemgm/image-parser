<?php
namespace Sip\ImageParser;

use Symfony\Component\DomCrawler\Crawler;

class SymfonyCrawlerParser extends AbstractParser
{
    public function setHtml(string $html): self
    {
        $crawler = new Crawler($html);
        $img = $crawler->filter('img');
        $links = $crawler->filter('a');

        foreach ($img as $tag) {
            $imgLink = (new Crawler($tag))->attr('src');
            if ($this->validateTag('src', $imgLink)) {
                $this->imgLength ++;
            }
        }

        foreach ($links as $tag) {
            $link = (new Crawler($tag))->attr('href');
            if ($this->validateTag('href', $link)) {
                $this->addLinks($link);
            }
        }
        return $this;
    }
}