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

namespace Skyzyx\StrongTypes;

use \ArrayObject;

class SetCollection extends ListCollection
{
    /**
     * {@inheritdoc}
     */
    public function __construct($value = [])
    {
        $this->value = array_unique($value, SORT_REGULAR);
        $this->validate();

        $this->collection = new ArrayObject($value, ArrayObject::ARRAY_AS_PROPS);
        $this->iterator   = $this->collection->getIterator();
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        $t = array_merge_recursive($this->value, [$value]);
        $t = array_unique($t, SORT_REGULAR);
        $t = array_values($t);

        $this->collection = new ArrayObject($t, ArrayObject::ARRAY_AS_PROPS);
        $this->iterator = $this->collection->getIterator();
        $this->value = $this->collection->getArrayCopy();

        return $this;
    }
}
