<?php

namespace Avanak\Tests;

use Avanak\Avanak;
use PHPUnit\Framework\TestCase;

class AvanakTest extends TestCase
{
    public function testVersionReturnsCorrectValue(): void
    {
        $avanak = new Avanak();
        $this->assertEquals('1.0.0', $avanak->version());
    }
}
