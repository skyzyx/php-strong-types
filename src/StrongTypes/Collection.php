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

use \ArrayAccess;
use \ArrayObject;
use \Countable;
use \DomainException;
use \IteratorAggregate;
use \InvalidArgumentException;
use \UnexpectedValueException;

class Collection extends AbstractShape implements CollectionInterface, IteratorAggregate, ArrayAccess, Countable
{
    use Collection\AliasTrait;
    use Collection\ArrayAccessTrait;
    use Collection\CountableTrait;
    use Collection\IteratorAggregateTrait;
    use Collection\SeekableInterfaceTrait;

    /** @var \ArrayObject */
    private $collection;

    /** @var array */
    private $required_keys = [];


    /**************************************************************************/
    // CONSTRUCTOR

    /**
     * Constructs a new instance of this class.
     *
     * @param array $value The standard array to convert into a collection. The default value is an empty string.
     */
    public function __construct($value = [])
    {
        $this->value = $value;
        $this->validate();

        $this->collection = new ArrayObject($value, ArrayObject::ARRAY_AS_PROPS);
        $this->iterator   = $this->collection->getIterator();
    }


    /**************************************************************************/
    // ShapeInterface

    /**
     * {@inheritdoc}
     */
    public function validate()
    {
        if ($this->value && is_array($this->value) === false) {
            throw new UnexpectedValueException(
                sprintf(self::TYPE_EXCEPTION_MESSAGE, get_called_class(), 'array', gettype($this->value))
            );
        }

        $map = $this->validateValue();
        $this->storeRequiredKeys($this->requiredKeys());

        if (is_array($this->value) === true) {
            foreach ($this->value as $k => $v) {
                // If the key is defined...
                if (isset($map[$k]) === true) {
                    // ...validate its shape.
                    if (($v instanceof $map[$k]) === false) {
                        throw new InvalidArgumentException(
                            sprintf('The %s shape expects the %s key to be of type %s.',
                                get_called_class(), $k, get_class($map[$k]))
                        );
                    }
                }

                if ($this->isRequiredKey($k) === true) {
                    $this->pluckFromRequiredKeys($k);
                }
            }
        }

        if (count($this->required_keys) !== 0) {
            throw new DomainException(
                sprintf('The %s collection is missing one or more required keys: %s.',
                    get_called_class(),
                    implode(', ', $this->getRemainingRequiredKeys())
                )
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->collection->getArrayCopy();
    }

    /**
     * The expected keys and data types of this shape.
     *
     * @return array The expected keys and data types of this shape.
     */
    public function validateValue()
    {
        /** @var array */
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function requiredKeys()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return json_encode($this->collection->getArrayCopy());
    }


    /**************************************************************************/
    // Helper Methods

    /**
     * Stores the list of required keys for processing.
     *
     * @param  array $keys The response from a call to `requiredKeys()`.
     * @return void
     */
    protected function storeRequiredKeys(array $keys)
    {
        $this->required_keys = array_flip($keys);
    }

    /**
     * Checks to see if a key is required.
     *
     * @param  string  $key The key to remove from the list of required keys.
     * @return boolean Whether or not a key is required. A value of `true` means that the key is required.
     *                     A value of `false` means that the key is NOT required.
     */
    protected function isRequiredKey($key)
    {
        return isset($this->required_keys[$key]);
    }

    /**
     * Plucks a key from the list of required keys, and returns the list of remaining keys.
     *
     * @param  string $key The key to remove from the list of required keys.
     * @return void
     */
    protected function pluckFromRequiredKeys($key)
    {
        if (isset($this->required_keys[$key]) === true) {
            unset($this->required_keys[$key]);
        }
    }

    /**
     * Gets the required keys that have not yet been set.
     *
     * @return array<string> The required keys that have not yet been set.
     */
    protected function getRemainingRequiredKeys()
    {
        return array_flip($this->required_keys);
    }
}
