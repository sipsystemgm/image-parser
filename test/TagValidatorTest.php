<?php

namespace Sip\ImageParser\Test;

use PHPUnit\Framework\TestCase;
use Sip\ImageParser\TagUrlValidator;

class TagValidatorTest extends TestCase
{
    public function testAttributeValidate(): void
    {
        $tagValidator = new TagUrlValidator('my-domain.com');
        $this->assertTrue($tagValidator->attributeValidate('/'));
        $this->assertTrue($tagValidator->attributeValidate('https://www.my-domain.com'));
        $this->assertTrue($tagValidator->attributeValidate('/some-url'));
        $this->assertFalse($tagValidator->attributeValidate('https://home.my-domain.com/some-url'));
    }
}