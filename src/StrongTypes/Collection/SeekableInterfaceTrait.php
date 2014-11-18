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

namespace Skyzyx\StrongTypes\Collection;

trait SeekableInterfaceTrait
{
    /**
     * Seek to a specific position in the collection.
     *
     * @see ArrayIterator::seek
     * @param  integer $position The location in the collection to seek to.
     * @return mixed   The value of the node at the seek location.
     */
    public function seek($position)
    {
        $this->iterator->rewind();
        $this->iterator->seek($position);

        return $this->iterator->current();
    }

    /**
     * Return the current entry in the collection.
     *
     * @see ArrayIterator::current()
     * @return mixed The current entry in the collection.
     */
    public function current()
    {
        return $this->iterator->current();
    }

    /**
     * Return the current key in the collection.
     *
     * @see ArrayIterator::key()
     * @return mixed The current key in the collection.
     */
    public function key()
    {
        return $this->iterator->key();
    }

    /**
     * Move to the next entry in the collection.
     *
     * @see ArrayIterator::next()
     * @return Collection A reference to the current collection.
     */
    public function next()
    {
        $this->iterator->next();

        return $this;
    }

    /**
     * Rewind pointer back to the beginning of the collection.
     *
     * @see ArrayIterator::rewind()
     * @return Collection A reference to the current collection.
     */
    public function rewind()
    {
        $this->iterator->rewind();

        return $this;
    }

    /**
     * Check whether or not the collection contains more entries.
     *
     * @see ArrayIterator::valid()
     * @return boolean A value of `true` indicates that the collection contains more entries. A value of `false`
     *                 indicates that there are no remaining entries.
     */
    public function valid()
    {
        return $this->iterator->valid();
    }
}
