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

namespace Skyzyx\StrongTypes;

use \UnexpectedValueException;

class OneOfCollection extends MapCollection
{
    /**************************************************************************/
    // ShapeInterface

    /**
     * {@inheritdoc}
     */
    public function validate()
    {
        parent::validate();

        if (!is_array($this->requireOneKey())) {
            throw new UnexpectedValueException(
                sprintf('The `requireOneKey()` method must retun an indexed array.')
            );
        }

        $array_keys = array_keys($this->getValue());
        $required_keys = array_flip($this->requireOneKey());

        if (count($required_keys) === 0) {
            return true;
        }

        foreach ($array_keys as $key) {
            if (isset($required_keys[$key])) {
                return true;
            }
        }

        throw new UnexpectedValueException(
            sprintf('The collection did not contain any of the required fields: %s',
                implode(', ', $this->requireOneKey())
            )
        );
    }

    /**
     * Gets a list of keys where one or more are required, but not all.
     *
     * @return array A list of keys where one or more are required, but not all.
     */
    public function requireOneKey()
    {
        return [];
    }
}
