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

namespace Skyzyx\StrongTypes\Collection;

trait ArrayObjectTrait
{
    /**
     * @aliasof ArrayObject::asort()
     * @return void
     */
    public function asort()
    {
        $this->collection->asort();
    }

    /**
     * @aliasof ArrayObject::exchangeArray()
     * @return array
     */
    public function exchangeArray($input)
    {
        return $this->collection->exchangeArray($input);
    }

    /**
     * @aliasof ArrayObject::getArrayCopy()
     * @return array
     */
    public function getArrayCopy()
    {
        return $this->collection->getArrayCopy();
    }

    /**
     * @aliasof ArrayObject::getFlags()
     * @return integer
     */
    public function getFlags()
    {
        return $this->collection->getFlags();
    }

    /**
     * @aliasof ArrayObject::ksort()
     * @return void
     */
    public function ksort()
    {
        $this->collection->ksort();
    }

    /**
     * @aliasof ArrayObject::natcasesort()
     * @return void
     */
    public function natcasesort()
    {
        $this->collection->natcasesort();
    }

    /**
     * @aliasof ArrayObject::natsort()
     * @return void
     */
    public function natsort()
    {
        $this->collection->natsort();
    }

    /**
     * @aliasof ArrayObject::setFlags()
     * @return void
     */
    public function setFlags($flags)
    {
        $this->collection->setFlags($flags);
    }

    /**
     * @aliasof ArrayObject::setIteratorClass()
     * @return void
     */
    public function setIteratorClass($iterator)
    {
        $this->collection->setIteratorClass($iterator);
    }

    /**
     * @aliasof ArrayObject::uasort()
     * @return void
     */
    public function uasort(callable $callback)
    {
        $this->collection->uasort($callback);
    }

    /**
     * @aliasof ArrayObject::uksort()
     * @return void
     */
    public function uksort(callable $callback)
    {
        $this->collection->uksort($callback);
    }
}
