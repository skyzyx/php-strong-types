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

use Skyzyx\StrongTypes\OneOfCollection;

class OneOfCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testOneOfCollectionValid1()
    {
        $this->assertEquals('', ''); // Shut-up, test runner

        new TestOneOfCollection([
            'key1' => true,
        ]);
        new TestOneOfCollection([
            'key2' => true,
        ]);
        new TestOneOfCollection([
            'key3' => true,
        ]);
        new TestOneOfCollection([
            'key1' => true,
            'key2' => true,
        ]);
        new TestOneOfCollection([
            'key2' => true,
            'key3' => true,
        ]);
        new TestOneOfCollection([
            'key1' => true,
            'key3' => true,
        ]);
        new TestOneOfCollection([
            'key1' => true,
            'key2' => true,
            'key3' => true,
        ]);
        new TestOneOfCollection([
            'key3' => true,
            'key4' => true,
        ]);
        new TestOneOfCollection([
            'key2' => true,
            'key3' => true,
            'key4' => true,
        ]);
        new TestOneOfCollection([
            'key1' => true,
            'key2' => true,
            'key3' => true,
            'key4' => true,
        ]);
    }

    public function testOneOfCollectionValid2()
    {
        $this->assertEquals('', ''); // Shut-up, test runner

        new OneOfCollection([
            'key1' => true,
        ]);
    }

    /**
     * @expectedException        UnexpectedValueException
     * @expectedExceptionMessage The collection did not contain any of the required fields: key1, key2, key3
     */
    public function testOneOfCollectionFail()
    {
        $this->assertEquals('', ''); // Shut-up, test runner

        new TestOneOfCollection([
            'key4' => true,
        ]);
    }

    /**
     * @expectedException        UnexpectedValueException
     * @expectedExceptionMessage The `requireOneKey()` method must retun an indexed array.
     */
    public function testOneOfCollectionFail2()
    {
        $this->assertEquals('', ''); // Shut-up, test runner

        new TestOneOfCollection2([
            'key1' => true,
        ]);
    }
}
