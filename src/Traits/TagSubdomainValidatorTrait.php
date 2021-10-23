<?php

namespace Sip\ImageParser\Traits;

trait TagSubdomainValidatorTrait
{
    private bool $isValidSubDomain = false;

    public function setIsValidSubdomain(bool $isValidSubDomain): self
    {
        $this->isValidSubDomain = $isValidSubDomain;
        return $this;
    }

    private function isSubDomain(string $url): bool
    {
        $parsedUrl = parse_url($url);
        return (
            $this->isValidSubDomain
            || (
                isset($parsedUrl['host'])
                && in_array($parsedUrl['host'], [$this->domain, 'www.'.$this->domain])
            )
        );

    }
}