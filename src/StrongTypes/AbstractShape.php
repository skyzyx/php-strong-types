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

/**
 * Base shape that all other shapes extend from.
 */
abstract class AbstractShape
{
    const TYPE_EXCEPTION_MESSAGE = 'The %s class expects a value of type %s. Received a value of type %s instead.';

    /** @var mixed */
    protected $value;

    /**
     * A map of Strong Types => native types.
     *
     * @var array<string>
     */
    protected $typemap = [
        'Skyzyx\\StrongTypes\\Boolean'    => 'boolean',
        'Skyzyx\\StrongTypes\\Collection' => 'array',
        'Skyzyx\\StrongTypes\\Integer'    => 'integer',
        'Skyzyx\\StrongTypes\\Float'      => 'double',
        'Skyzyx\\StrongTypes\\String'     => 'string',
    ];

    /**
     * Constructs a new instance of this object.
     *
     * @param mixed $value The value to assign to the instance.
     */
    public function __construct($value = null)
    {
        $this->value = $value;
        $this->validate();
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Returns the typemap.
     *
     * @return array<string> The typemap.
     */
    public function getTypeMap()
    {
        return $this->typemap;
    }

    /**
     * Gets the name of the native type that pairs with the Strong Type.
     *
     * @param  ShapeInterface $value A strongly-typed object.
     * @return string         The name of the native type.
     */
    public function getNativeType(ShapeInterface $value)
    {
        foreach ($this->typemap as $type => $native) {
            if (is_a($value, $type)) {
                return $native;
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->value;
    }
}
