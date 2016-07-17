<?php
/**
 * Copyright (c) 2014-2016 Ryan Parman.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * http://opensource.org/licenses/MIT
 */

namespace Skyzyx\Tests\StrongTypes;

use Skyzyx\StrongTypes as IO;

class UtilTest extends \PHPUnit_Framework_TestCase
{
    public function testBooleanType()
    {
        $this->assertEquals('Skyzyx\StrongTypes\BooleanType',
            IO\Util::getClassOrType(
                IO\Util::getStrongScalarType('true')
            )
        );

        $this->assertEquals('Skyzyx\StrongTypes\BooleanType',
            IO\Util::getClassOrType(
                IO\Util::getStrongScalarType('false')
            )
        );

        $this->assertEquals('Skyzyx\StrongTypes\BooleanType',
            IO\Util::getClassOrType(
                IO\Util::getStrongScalarType(true)
            )
        );
    }

    public function testFloatType()
    {
        $this->assertEquals('Skyzyx\StrongTypes\FloatType',
            IO\Util::getClassOrType(
                IO\Util::getStrongScalarType('123456.789')
            )
        );

        $this->assertEquals('Skyzyx\StrongTypes\FloatType',
            IO\Util::getClassOrType(
                IO\Util::getStrongScalarType(123456.789)
            )
        );
    }

    public function testIntegerType()
    {
        $this->assertEquals('Skyzyx\StrongTypes\IntegerType',
            IO\Util::getClassOrType(
                IO\Util::getStrongScalarType('123456789')
            )
        );

        $this->assertEquals('Skyzyx\StrongTypes\IntegerType',
            IO\Util::getClassOrType(
                IO\Util::getStrongScalarType(123456789)
            )
        );
    }

    public function testStringType()
    {
        $this->assertEquals('Skyzyx\StrongTypes\StringType',
            IO\Util::getClassOrType(
                IO\Util::getStrongScalarType('abc123')
            )
        );
    }

    public function testValidatedBooleanType()
    {
        $this->assertEquals(true,
            IO\Util::getValidatedValue(
                new IO\BooleanType(true)
            )
        );
    }

    public function testValidatedFloatType()
    {
        $this->assertEquals(123456.789,
            IO\Util::getValidatedValue(
                new IO\FloatType(123456.789)
            )
        );
    }

    public function testValidatedIntegerType()
    {
        $this->assertEquals(123456789,
            IO\Util::getValidatedValue(
                new IO\IntegerType(123456789)
            )
        );
    }

    public function testValidatedStringType()
    {
        $this->assertEquals('abc123',
            IO\Util::getValidatedValue(
                new IO\StringType('abc123')
            )
        );
    }
}
