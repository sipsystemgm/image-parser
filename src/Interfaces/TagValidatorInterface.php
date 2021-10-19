<?php

namespace Sip\ImageParser\Interfaces;

interface TagValidatorInterface
{
    public function attributeValidate(string $value): bool;
}