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

        $this->assertFalse($tagValidator->attributeValidate('https://www.subdomain.my-domain.com'));
        $this->assertFalse($tagValidator->attributeValidate('https://subdomain.my-domain.com'));

        $this->assertFalse($tagValidator->attributeValidate('javascript: void(0)'));
        $this->assertFalse($tagValidator->attributeValidate('viber://@some-viber'));
        $this->assertFalse($tagValidator->attributeValidate('tel://0111'));

    }

    public function testIsValidSubdomain(): void
    {
        $tagValidator = new TagUrlValidator('my-domain.com');
        $tagValidator->setIsValidSubdomain(true);
        $this->assertTrue($tagValidator->attributeValidate('https://www.subdomain.my-domain.com'));
    }
}
