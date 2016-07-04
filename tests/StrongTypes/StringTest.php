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

use Skyzyx\StrongTypes\StringType;
use Skyzyx\StrongTypes\StringType\Utf8String;
use Skyzyx\StrongTypes\Util;

class StringTest extends \PHPUnit_Framework_TestCase
{
    public function testStringType()
    {
        $type = new StringType('abc');

        $this->assertEquals('Skyzyx\StrongTypes\StringType', get_class($type));
        $this->assertEquals('abc', (string) $type);
        $this->assertEquals('abc', $type->getValue());
    }

    /**
     * @expectedException        UnexpectedValueException
     * @expectedExceptionMessage The Skyzyx\StrongTypes\StringType class expects a value of type string.
     *                           Received a value of type integer instead.
     */
    public function testStringException()
    {
        $this->assertEquals('', ''); // Shut-up, test runner
        new StringType(123);
    }

    public function testClassOrType()
    {
        $type = new StringType('abc');
        $this->assertEquals('string', Util::getClassOrType('abc'));
        $this->assertEquals('Skyzyx\StrongTypes\StringType', Util::getClassOrType($type));
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
     * @expectedException        LengthException
     * @expectedExceptionMessage The length of the Skyzyx\Tests\StrongTypes\TestUtf8String object is 3,
     *                           but MUST be between 5 and 20.
     */
    public function testMinUtf8LengthOk()
    {
        $this->assertEquals('', ''); // Shut-up, test runner
        new TestUtf8String('æœ℅');
    }

    public function testMaxUtf8LengthOk()
    {
        $this->assertEquals('', ''); // Shut-up, test runner
        new TestUtf8String('ಠ_ಠ ♪♫℃℉αβΔΣ‼︎⁈…æœ℅␛');
        new TestUtf8String('나는 유리를 먹을 수 있어요. 그래도');
    }

    public function testAsciiFromUnicode()
    {
        $ascii = StringType::fromUnicode('\u0041\u0042\u0043');
        $this->assertEquals('ABC', $ascii->getValue());
    }

    public function testAsciiFromUnicode2()
    {
        $ascii = StringType::fromUnicode('\u1F60A');
        $this->assertEquals('😊', $ascii->getValue());
        $this->assertEquals(4, $ascii->getLength()); // String will always get this wrong for multibyte.
    }

    public function testUtf8FromUnicode()
    {
        $utf8 = Utf8String::fromUnicode('\u1F60A');
        $this->assertEquals('😊', $utf8->getValue());
        $this->assertEquals(1, $utf8->getLength()); // Utf8String should always get this right.
    }

    public function testAsciiFromBytes()
    {
        $ascii = StringType::fromBytes('\xF0\x9F\x98\x8A');
        $this->assertEquals('😊', $ascii->getValue());
        $this->assertEquals(4, $ascii->getLength()); // String will always get this wrong for multibyte.
    }

    public function testUtf8FromBytes()
    {
        $utf8 = Utf8String::fromBytes('\xF0\x9F\x98\x8A');
        $this->assertEquals('😊', $utf8->getValue());
        $this->assertEquals(1, $utf8->getLength()); // Utf8String should always get this right.
    }

    public function testUtf8FromBytes2()
    {
        $utf8 = Utf8String::fromBytes('Look at me smile! \xF0\x9F\x98\x8A');
        $this->assertEquals('Look at me smile! 😊', $utf8->getValue());
    }
}
