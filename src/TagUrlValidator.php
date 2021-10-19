<?php

namespace Sip\ImageParser;

use Sip\ImageParser\Interfaces\TagValidatorInterface;

class TagUrlValidator implements TagValidatorInterface
{
    private string $domain;

    public function __construct(string $domain)
    {
        $this->domain = $domain;
    }

    public function attributeValidate(string $value): bool
    {
        $parsedUrl = parse_url($value);
        return empty($parsedUrl['host']) ||
            $parsedUrl['host'] == $this->domain ||
            $parsedUrl['host'] == 'www.'. $this->domain
        ;
    }
}