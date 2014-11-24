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

use Skyzyx\StrongTypes\String;
use Skyzyx\StrongTypes\Util;

class StringTest extends \PHPUnit_Framework_TestCase
{
    public function testStringType()
    {
        $type = new String('abc');

        $this->assertEquals('Skyzyx\StrongTypes\String', get_class($type));
        $this->assertEquals('abc', (string) $type);
        $this->assertEquals('abc', $type->getValue());
    }

    /**
     * @expectedException        UnexpectedValueException
     * @expectedExceptionMessage The Skyzyx\StrongTypes\String class expects a value of type string.
     *                           Received a value of type integer instead.
     */
    public function testStringException()
    {
        $this->assertEquals('', ''); // Shut-up, test runner
        new String(123);
    }

    public function testClassOrType()
    {
        $type = new String('abc');
        $this->assertEquals('string', Util::getClassOrType('abc'));
        $this->assertEquals('Skyzyx\StrongTypes\String', Util::getClassOrType($type));
    }

    public function testExactLengthOk()
    {
        $this->assertEquals('', ''); // Shut-up, test runner
        new TestString2('abcde');
    }

    /**
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage The parameter was expecting an integer, but instead received a value of type string.
     */
    public function testExactLengthFail()
    {
        $this->assertEquals('', ''); // Shut-up, test runner
        new TestString3('abcde');
    }

    /**
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage The parameter was expecting an integer, but instead received a value of type
     *                           Skyzyx\StrongTypes\String.
     */
    public function testExactLengthFail2()
    {
        $this->assertEquals('', ''); // Shut-up, test runner
        new TestString4('abcde');
    }

    public function testLengthOk()
    {
        $this->assertEquals('', ''); // Shut-up, test runner
        new TestString('abcdefghijkl');
    }

    public function testLengthOk2()
    {
        $this->assertEquals('', ''); // Shut-up, test runner
        new TestString('ಠ_ಠ');
    }

    /**
     * @expectedException        LengthException
     * @expectedExceptionMessage The length of the Skyzyx\Tests\StrongTypes\TestString object is 3,
     *                           but MUST be between 5 and 20.
     */
    public function testMinLengthFail()
    {
        $this->assertEquals('', ''); // Shut-up, test runner
        new TestString('abc');
    }

    /**
     * @expectedException        LengthException
     * @expectedExceptionMessage The length of the Skyzyx\Tests\StrongTypes\TestString object is 26,
     *                           but MUST be between 5 and 20.
     */
    public function testMaxLengthFail()
    {
        $this->assertEquals('', ''); // Shut-up, test runner
        new TestString('abcdefghijklmnopqrstuvwxyz');
    }

    /**
     * @expectedException        LengthException
     * @expectedExceptionMessage The length of the Skyzyx\Tests\StrongTypes\TestString object is 50,
     *                           but MUST be between 5 and 20.
     */
    public function testMaxLengthFail2()
    {
        $this->assertEquals('', ''); // Shut-up, test runner
        new TestString('ಠ_ಠ ♪♫℃℉αβΔΣ‼︎⁈…æœ℅␛');
    }

    /**
     * @requires PHP 5.6
     * @expectedException        LengthException
     * @expectedExceptionMessage The length of the Skyzyx\Tests\StrongTypes\TestMultibyteString object is 3,
     *                           but MUST be between 5 and 20.
     */
    public function testMinMultibyteLengthOk()
    {
        $this->assertEquals('', ''); // Shut-up, test runner
        new TestMultibyteString('æœ℅');
    }

    /**
     * @requires PHP 5.6
     */
    public function testMaxMultibyteLengthOk()
    {
        $this->assertEquals('', ''); // Shut-up, test runner
        new TestMultibyteString('ಠ_ಠ ♪♫℃℉αβΔΣ‼︎⁈…æœ℅␛');
    }
}
