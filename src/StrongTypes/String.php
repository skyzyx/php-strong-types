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

use \InvalidArgumentException;
use \LengthException;
use \UnexpectedValueException;

class String extends AbstractShape implements StringInterface, SingleValueInterface
{
    /** @var integer */
    protected $min = 0;

    /** @var integer */
    protected $max = \PHP_INT_MAX;

    /**
     * {@inheritdoc}
     */
    public function validate(callable $callback = null)
    {
        $callback = $callback ?: function ($string) {
            return strlen($string);
        };

        if ($this->value !== null && !is_string($this->value)) {
            throw new UnexpectedValueException(
                sprintf(self::TYPE_EXCEPTION_MESSAGE, get_called_class(), 'string', $this->getClassOrType($this->value))
            );
        }

        $length = $callback($this->value);

        if ($length < $this->min || $length > $this->max) {
            throw new LengthException(
                sprintf('The length of the %s object is %s, but MUST be between %s and %s.',
                    get_called_class(),
                    $length,
                    $this->min,
                    $this->max
                )
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setMinLength($length)
    {
        $this->validateAsInteger($length);
        $this->min = $length;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setMaxLength($length)
    {
        $this->validateAsInteger($length);
        $this->max = $length;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setExactLength($length)
    {
        $this->validateAsInteger($length);
        $this->min = $length;
        $this->max = $length;

        return $this;
    }

    /**
     * Validates that the parameter was an integer.
     *
     * @param  integer $param The value to check.
     * @return void
     *
     * @throws InvalidArgumentException
     */
    protected function validateAsInteger($param)
    {
        if (!is_int($param)) {
            throw new InvalidArgumentException(
                sprintf('The parameter was expecting an integer, but instead received a value of type %s.',
                    $this->getClassOrType($param)
                )
            );
        }
    }
}
