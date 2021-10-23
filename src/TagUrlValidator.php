<?php

namespace Sip\ImageParser;

use Sip\ImageParser\Interfaces\TagUrlSchemeValidator;
use Sip\ImageParser\Interfaces\TagUrlSubdomainValidatorInterface;
use Sip\ImageParser\Interfaces\TagValidatorInterface;
use Sip\ImageParser\Traits\TagSubdomainValidatorTrait;
use Sip\ImageParser\Traits\TagUrlSchemeValidatorTrait;

class TagUrlValidator implements TagValidatorInterface, TagUrlSubdomainValidatorInterface, TagUrlSchemeValidator
{
    use TagSubdomainValidatorTrait, TagUrlSchemeValidatorTrait;

    private string $domain;

    public function __construct(string $domain)
    {
        $this->domain = $domain;
    }

    public function attributeValidate(string $value): bool
    {
        $this->isSubDomain($value);
         return  (
            filter_var($value, FILTER_VALIDATE_URL) !== false
            && $this->isAllowSchemes($value, ['http', 'https'])
            && $this->isSubDomain($value)
        ) || substr($value, 0, 1) == '/';
    }
}

