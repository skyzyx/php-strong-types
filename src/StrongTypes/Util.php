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

class Util
{
    /**
     * Gets the most useful description of the value's type.
     *
     * @param  mixed  $param The value to check.
     * @return string The description of the type of the value.
     */
    public static function getClassOrType($param)
    {
        $type = gettype($param);

        if ($type === 'object') {
            return get_class($param);
        }

        return $type;
    }

    /**
     * Gets the strongly-typed version of a scalar type.
     *
     * @param  mixed                $value The scalar value to convert to a strong type.
     * @return SingleValueInterface A Boolean, Integer, Float or String type.
     */
    public static function getStrongScalarType($value)
    {
        if ($value === 'true' || $value === 'false') {
            return new Boolean($value === 'true');
        } elseif (is_bool($value)) {
            return new Boolean($value);
        } elseif (is_string($value) && is_numeric($value)) {
            if (strpos($value, '.') !== false) {
                return new Float((float) $value);
            } else {
                return new Integer((integer) $value);
            }
        } elseif (is_int($value)) {
            return new Integer($value);
        } elseif (is_float($value)) {
            return new Float($value);
        } else {
            return new String((string) $value);
        }
    }
}
