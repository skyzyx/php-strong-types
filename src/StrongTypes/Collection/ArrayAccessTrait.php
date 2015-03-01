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

namespace Skyzyx\StrongTypes\Collection;

trait ArrayAccessTrait
{
    /**
     * Check whether or not a specific offset exists.
     *
     * @aliasof exists
     * @param  integer $offset The location in the collection to verify the existence of.
     * @return boolean A value of `true` indicates that the collection offset exists. A value of `false`
     *                        indicates that it does not.
     */
    public function offsetExists($offset)
    {
        return $this->collection->offsetExists($offset);
    }

    /**
     * Get the value for a specific offset.
     *
     * @aliasof get
     * @param  integer $offset The location in the collection to retrieve the value for.
     * @return mixed   The value of the collection offset. `NULL` is returned if the offset does not exist.
     */
    public function offsetGet($offset)
    {
        if ($this->collection->offsetExists($offset)) {
            return $this->collection->offsetGet($offset);
        }

        return null;
    }

    /**
     * Set the value for a specific offset.
     *
     * @aliasof set
     * @param integer $offset The location in the collection to set a new value for.
     * @param mixed   $value  The new value for the collection location.
     */
    public function offsetSet($offset, $value)
    {
        $this->collection->offsetSet($offset, $value);
        $this->value = $this->collection->getArrayCopy();

        return $this;
    }

    /**
     * Unset the value for a specific offset.
     *
     * @aliasof remove
     * @param integer $offset The location in the collection to unset.
     */
    public function offsetUnset($offset)
    {
        $this->collection->offsetUnset($offset);
        $this->value = $this->collection->getArrayCopy();

        return $this;
    }
}
