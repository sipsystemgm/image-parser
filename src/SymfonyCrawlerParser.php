<?php
namespace Sip\ImageParser;

use Symfony\Component\DomCrawler\Crawler;

class SymfonyCrawlerParser extends AbstractParser
{
    public function setHtml(string $html): self
    {
        $this->parseImage($html);
        $this->parseLink($html);
        return $this;
    }

    protected function parseImage(string $html): void
    {
        $crawler = new Crawler($html);
        $img = $crawler->filter('img');

        foreach ($img as $tag) {
            $imgLink = (new Crawler($tag))->attr('src');
            if ($this->validateTag('src', $imgLink)) {
                $this->imgLength ++;
            }
        }
    }

    protected function parseLink(string $html): void
    {
        $crawler = new Crawler($html);
        $links = $crawler->filter('a');

        foreach ($links as $tag) {
            $link = (new Crawler($tag))->attr('href');
            if ($this->validateTag('href', $link)) {
                $this->addLinks($link);
            }
        }
    }
}