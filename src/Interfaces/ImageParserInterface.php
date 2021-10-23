<?php
namespace Sip\ImageParser\Interfaces;

interface ImageParserInterface
{
    public function addTagValidators(string $tagName, ?TagValidatorInterface $validator): self;
    public function getImgLength(): int;
    public function getExecutionTime(): float;
    public function getLinks(): array;
    public function setHtml(string $html): self;
}