<?php

namespace Sip\ImageParser;

use Sip\ImageParser\Interfaces\TagValidatorInterface;

class TagUrlValidator implements TagValidatorInterface
{
    private string $domain;
    private bool $isValidSubDomain = false;

    public function __construct(string $domain)
    {
        $this->domain = $domain;
    }

    public function setIsValidSubdomain(bool $isValidSubDomain): self
    {
        $this->isValidSubDomain = $isValidSubDomain;
        return $this;
    }

    public function attributeValidate(string $value): bool
    {
        $parsedUrl = parse_url($value);

        $isValidSubdomain = (
            $this->isValidSubDomain
            || (
                isset($parsedUrl['host'])
                && in_array($parsedUrl['host'], [$this->domain, 'www.'.$this->domain])
            )
        );

         return  (
            filter_var($value, FILTER_VALIDATE_URL) !== false
            && isset($parsedUrl['scheme'])
            && in_array($parsedUrl['scheme'], ['http', 'https'])
            && $isValidSubdomain
        ) || substr($value, 0, 1) == '/';

    }
}