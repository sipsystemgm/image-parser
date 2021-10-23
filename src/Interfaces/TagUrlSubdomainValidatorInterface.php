<?php

namespace Sip\ImageParser\Interfaces;

interface TagUrlSubdomainValidatorInterface
{
    public function setIsValidSubdomain(bool $isValidSubDomain): self;
}