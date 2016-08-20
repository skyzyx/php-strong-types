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

namespace Skyzyx\StrongTypes\StringType;

use Skyzyx\StrongTypes\SingleValueInterface;
use Skyzyx\StrongTypes\StringType;
use UnexpectedValueException;

class Regex extends StringType implements RegexInterface
{
    /**
     * {@inheritdoc}
     */
    public function validate()
    {
        // Sensio Insight *hates* this `@` operator. Because this function spews an E_WARNING, we have no choice but to silence it. :rageface:
        if (@preg_match($this->value, null) === false) {

            $etype = array_flip(get_defined_constants(true)['pcre'])[preg_last_error()];

            throw new UnexpectedValueException(
                sprintf('There is a problem with the value "%s". [%s]', $this->value, $etype)
            );
        }
    }

    public function test(SingleValueInterface $comparator)
    {
        # code...
    }
}
