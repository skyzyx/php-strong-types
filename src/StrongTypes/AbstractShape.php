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

namespace Skyzyx\StrongTypes;

/**
 * Base shape that all other shapes extend from.
 */
abstract class AbstractShape
{
    const TYPE_EXCEPTION_MESSAGE = 'The %s class expects a value of type %s. Received a value of type %s instead.';

    /** @var mixed */
    protected $value;

    /**
     * Constructs a new instance of this object.
     *
     * @param integer|null $value The value to assign to the instance.
     */
    public function __construct($value = null)
    {
        $this->value = $value;
        $this->validate();
    }

    /**
     * Gets the most useful description of the value's type.
     *
     * @param  mixed  $param The value to check.
     * @return string The description of the type of the value.
     */
    public function getClassOrType($param)
    {
        $type = gettype($param);

        if ($type === 'object') {
            return get_class($param);
        }

        return $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->value;
    }
}
