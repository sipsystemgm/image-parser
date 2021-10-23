<?php

namespace Sip\ImageParser\Interfaces;

interface TagUrlSchemeValidator
{
    public function isAllowSchemes(string $url, array $schemes): bool;
}