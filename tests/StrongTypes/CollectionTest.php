<?php
/**
 * Copyright (c) 2014-2015 Ryan Parman.
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

use Skyzyx\StrongTypes\Boolean;
use Skyzyx\StrongTypes\Collection;
use Skyzyx\StrongTypes\Float;
use Skyzyx\StrongTypes\Integer;
use Skyzyx\StrongTypes\String;

class CollectionTest extends \PHPUnit_Framework_TestCase
{
    public $type;

    public function setUp()
    {
        $this->type = new Collection([
            'abc' => 'xyz',
            'def' => 123,
        ]);
    }

    public function testCollectionType()
    {
        $this->assertEquals('Skyzyx\StrongTypes\Collection', get_class($this->type));
        $this->assertEquals([
            'abc' => 'xyz',
            'def' => 123,
        ], $this->type->getValue());
    }

    public function testCollectionCount()
    {
        $this->assertEquals(2, count($this->type));
        $this->assertEquals(2, $this->type->count());
        $this->assertEquals(2, $this->type->length());
        $this->assertEquals(2, $this->type->size());
    }

    public function testCollectionAppend()
    {
        $this->type['xyz'] = 123;
        $this->type->set('uvw', 456);

        $this->assertEquals(123, $this->type['xyz']);
        $this->assertEquals(456, $this->type->get('uvw'));
        $this->assertEquals(4, count($this->type));
    }

    public function testCollectionGetInvalid()
    {
        $this->assertEquals(null, $this->type->get('aaa'));
        $this->assertEquals(null, $this->type['aaa']);
    }

    public function testCollectionRemove()
    {
        unset($this->type['abc']);
        $this->type->remove('def');

        $this->assertEquals(0, count($this->type));
    }

    public function testCollectionSeek()
    {
        $set = [];

        $this->type->rewind();
        while ($this->type->valid()) {
            $set[$this->type->key()] = $this->type->current();
            $this->type->next();
        }

        $this->assertEquals([
            'abc' => 'xyz',
            'def' => 123,
        ], $set);
    }

    public function testCollectionToString()
    {
        $this->assertEquals(json_encode([
            'abc' => 'xyz',
            'def' => 123,
        ]),
        (string) $this->type);
    }

    public function testCollectionDeepArray()
    {
        $collection = new Collection([
            'abc' => 'xyz',
            'def' => 123,
            'key' => [
                'zyx'  => 'aaa',
                'wvut' => 'bbb',
                'srqp' => 'ccc',
            ],
        ]);

        $this->assertEquals(json_encode([
            'abc' => 'xyz',
            'def' => 123,
            'key' => [
                'zyx'  => 'aaa',
                'wvut' => 'bbb',
                'srqp' => 'ccc',
            ],
        ]),
        (string) $collection);
    }

    public function testCollectionDeepArrayFail()
    {
        $collection = new Collection([
            'abc' => 'xyz',
            'def' => 123,
            'key' => [
                'zyx'  => 'aaa',
                'wvut' => 'bbb',
                'srqp' => 'ccc',
            ],
        ], true);

        $this->assertNotEquals(json_encode([
            'abc' => 'xyz',
            'def' => 123,
            'key' => [],
        ]),
        (string) $collection);
    }

    public function testCollectionExists()
    {
        $this->assertEquals(true, isset($this->type['abc']));
        $this->assertEquals(true, $this->type->exists('abc'));
    }

    public function testCollectionSeekable()
    {
        $this->assertEquals('xyz', $this->type->seek(0));
    }

    public function testCollectionForeach()
    {
        $set = [];

        foreach ($this->type->getIterator() as $k => $v) {
            $set[$k] = $v;
        }

        $this->assertEquals([
            'abc' => 'xyz',
            'def' => 123,
        ], $set);
    }

    public function testCollectionValidation()
    {
        $this->assertEquals('', ''); // Shut-up, test runner
        new TestCollection([
            'key1' => new String('abc'),
            'key2' => new Integer(123),
            'key3' => new Float(123.456),
            'key4' => new Boolean(true),
            'key5' => new TestEnum(),
            'key6' => new Collection([]),
        ]);
    }

    public function testCollectionValidationStringException()
    {
        $this->assertEquals('', ''); // Shut-up, test runner
        new TestCollection([
            'key1' => 'abc',
            'key2' => new Integer(123),
            'key3' => new Float(123.456),
            'key4' => new Boolean(true),
            'key5' => new TestEnum(),
            'key6' => new Collection([]),
        ]);
    }

    public function testCollectionValidationIntegerException()
    {
        $this->assertEquals('', ''); // Shut-up, test runner
        new TestCollection([
            'key1' => new String('abc'),
            'key2' => 123,
            'key3' => new Float(123.456),
            'key4' => new Boolean(true),
            'key5' => new TestEnum(),
            'key6' => new Collection([]),
        ]);
    }

    /**
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage The Skyzyx\Tests\StrongTypes\TestCollection shape expects the key2 key
     *                           to be of type Skyzyx\StrongTypes\Integer.
     */
    public function testCollectionValidationIntegerException2()
    {
        $this->assertEquals('', ''); // Shut-up, test runner
        new TestCollection([
            'key1' => new String('abc'),
            'key2' => 123.45,
            'key3' => new Float(123.456),
            'key4' => new Boolean(true),
            'key5' => new TestEnum(),
            'key6' => new Collection([]),
        ]);
    }

    /**
     * @expectedException        DomainException
     * @expectedExceptionMessage The Skyzyx\Tests\StrongTypes\TestCollection collection is missing one or
     *                           more required keys: key1, key2.
     */
    public function testCollectionValidationMissingRequiredException()
    {
        $this->assertEquals('', ''); // Shut-up, test runner
        new TestCollection([
            'key3' => new Float(123.456),
            'key4' => new Boolean(true),
            'key5' => new TestEnum(),
            'key6' => new Collection([]),
        ]);
    }

    public function testCollectionValidationDisallowedException()
    {
        $this->assertEquals('', ''); // Shut-up, test runner
        new TestCollection([
            'key1' => new String('abc'),
            'key2' => new Integer(123),
            'key3' => new Float(123.456),
            'key4' => new Boolean(true),
            'key5' => new TestEnum(),
            'key6' => new Collection([]),
            'key7' => null,
        ]);
    }

    /**
     * @expectedException        OutOfBoundsException
     * @expectedExceptionMessage Seek position 99 is out of range
     */
    public function testCollectionSeekableException()
    {
        $this->assertEquals('fail', $this->type->seek(99));
    }

    /**
     * @expectedException        UnexpectedValueException
     * @expectedExceptionMessage The Skyzyx\StrongTypes\Collection class expects a value of type array.
     *                           Received a value of type string instead.
     */
    public function testCollectionException()
    {
        $this->assertEquals('', ''); // Shut-up, test runner
        new Collection('abc');
    }
}
