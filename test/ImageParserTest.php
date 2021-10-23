<?php

namespace Sip\ImageParser\Test;

use PHPUnit\Framework\TestCase;
use Sip\ImageParser\PregParser;
use Sip\ImageParser\SymfonyCrawlerParser;
use Sip\ImageParser\TagUrlValidator;

class ImageParserTest extends TestCase
{
    public function testImagesTagsAndLinks(): void
    {
        $html = $this->getHtmlWithImagesAndLinks();

        foreach ($this->getParsersArray() as $parser) {
            $parser->setHtml($html);

            $this->assertEquals([
                "/page3.html",
                "https://www.mydomain.com/page3.html"
            ], $parser->getLinks());

            $this->assertEquals(2, $parser->getImgLength());
            $this->assertTrue($parser->getExecutionTime() > 0);

        }
    }

    public function testDeleteTagValidator(): void
    {
        $tagValidator = new TagUrlValidator('some-domain.com');
        $validatorName = 'url_test_validator';

        foreach ($this->getParsersArray() as $parser) {
            $this->assertFalse($parser->deleteTagValidator($validatorName));
            $parser->addTagValidators($validatorName, $tagValidator);
            $this->assertTrue($parser->deleteTagValidator($validatorName));
        }
    }

    private function getHtmlWithImagesAndLinks(): string
    {
        return '<!DOCTYPE html>
                    <html>
                        <body>
                            <p class="message">Hello World!</p>
                            <img src="https://some-soft.com/img/user1.gif">
                            <img src="http://some-soft.com/img/user2.jpg">
                            <img src="/img/user3.jpg">
                            <img src="https://www.mydomain.com/img/user3.jpg">
                            <p>Hello Crawler!</p>
                            <a href="https://some-soft.com/page1.html">Page 1</a>
                            <a href="http://some-soft.com/page2.html">Page 2</a>
                            <a href="/page3 .  
                             html">Page 2</a>
                            <a href="https://www.mydomain.com/page3.html">Page 2</a>
                        </body>
                    </html>';
    }

    private function getParsersArray(): array
    {
        $tagUrlValidator = new TagUrlValidator('mydomain.com');
        $symfonyCrowler = new SymfonyCrawlerParser();

        $symfonyCrowler->addTagValidators('src', $tagUrlValidator);
        $symfonyCrowler->addTagValidators('href', $tagUrlValidator);

        $pregParser = new PregParser();
        $pregParser->addTagValidators('src', $tagUrlValidator);
        $pregParser->addTagValidators('href', $tagUrlValidator);

        return [
            $symfonyCrowler,
            $pregParser
        ];
    }
}
