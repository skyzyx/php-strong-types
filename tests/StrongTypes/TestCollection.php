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

use Skyzyx\StrongTypes\BooleanType;
use Skyzyx\StrongTypes\Collection;
use Skyzyx\StrongTypes\CollectionInterface;
use Skyzyx\StrongTypes\Enum;
use Skyzyx\StrongTypes\FloatType;
use Skyzyx\StrongTypes\IntegerType;
use Skyzyx\StrongTypes\StringType;

class TestCollection extends Collection implements CollectionInterface
{
    /**
     * {@inheritdoc}
     */
    public function validateValue()
    {
        /** @var array */
        return [
            'key1' => new StringType(),
            'key2' => new IntegerType(),
            'key3' => new FloatType(),
            'key4' => new BooleanType(),
            'key5' => new Enum(),
            'key6' => new Collection(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function requiredKeys()
    {
        /** @var array */
        return [
            'key1',
            'key2',
            'key3',
            'key4',
            'key5',
            'key6',
        ];
    }
}
