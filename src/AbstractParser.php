<?php

namespace Sip\ImageParser;

use Sip\ImageParser\Interfaces\ImageParserInterface;
use Sip\ImageParser\Interfaces\TagValidatorInterface;

abstract class AbstractParser implements ImageParserInterface
{
    private array $tagValidators = [];
    private array $links = [];
    private float $executionTime = 0.0;
    protected int $imgLength = 0;

    public function __construct()
    {
        $this->executionTime = microtime(true);
    }

    public function addTagValidators(string $tagName, TagValidatorInterface $validator): self
    {
         $this->tagValidators[$tagName] = $validator;
         return $this;
    }

    public function getImgLength(): int
    {
        return $this->imgLength;
    }

    public function getExecutionTime(): float
    {
        if ($this->executionTime > 0) {
            $this->executionTime = microtime(true) - $this->executionTime;
        }
        return $this->executionTime;
    }

    public function getLinks(): array
    {
        return $this->links;
    }

    protected function validateTag(string $tagName, string $value): bool
    {
        $validator = $this->getTagValidator($tagName);
        if ($validator !== null) {
            return $validator->attributeValidate($value);
        }
        return true;
    }

    protected function addLinks(string $link): self
    {
        if (!in_array($link, $this->links)) {
            $this->links[] = preg_replace('/\s+|\t+/', '', $link);
        }
        return $this;
    }

    protected function getTagValidator(string $tagName): ?TagValidatorInterface
    {
        if (!empty($this->tagValidators[$tagName])) {
            return $this->tagValidators[$tagName];
        }
        return null;
    }
}

