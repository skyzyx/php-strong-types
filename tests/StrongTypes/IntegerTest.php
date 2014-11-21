<?php
/**
 * Copyright (c) 2014 Ryan Parman.
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

use Skyzyx\StrongTypes\Integer;

class IntegerTest extends \PHPUnit_Framework_TestCase
{
    public function testIntegerType()
    {
        $type = new Integer(123);

        $this->assertEquals('Skyzyx\StrongTypes\Integer', get_class($type));
        $this->assertEquals(123, $type->getValue());
    }

    /**
     * @expectedException        UnexpectedValueException
     * @expectedExceptionMessage The Skyzyx\StrongTypes\Integer class expects a value of type integer. Received a
     *                           value of type string instead.
     */
    public function testIntegerExceptionString()
    {
        $this->assertEquals('', ''); // Shut-up, test runner
        new Integer('abc');
    }

    /**
     * @expectedException        UnexpectedValueException
     * @expectedExceptionMessage The Skyzyx\StrongTypes\Integer class expects a value of type integer. Received a
     *                           value of type float instead.
     */
    public function testIntegerExceptionFloat()
    {
        $this->assertEquals('', ''); // Shut-up, test runner
        new Integer(1.23);
    }

    public function testIntegerToString()
    {
        $this->assertEquals('12345', (string) new Integer(12345));
        $this->assertEquals('9223372036854775807', (string) new Integer(\PHP_INT_MAX));
    }
}
