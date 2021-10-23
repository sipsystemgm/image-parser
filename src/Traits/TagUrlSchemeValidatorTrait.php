<?php

namespace Sip\ImageParser\Traits;

trait TagUrlSchemeValidatorTrait
{
    public function isAllowSchemes(string $url, array $schemes): bool
    {
        $parsedUrl = parse_url($url);
        return (isset($parsedUrl['scheme'])
            && in_array($parsedUrl['scheme'], $schemes));
    }
}