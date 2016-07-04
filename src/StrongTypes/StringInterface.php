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

interface StringInterface extends ShapeInterface
{
    /**
     * Converts hexadecimal byte markers (e.g., `\xF0\x9F\x98\x8A`) to a String object made of the markers' value.
     *
     * @param  string                    $value A hexadecimal byte marker codepoint (e.g., `\xF0\x9F\x98\x8A`).
     * @return Skyzyx\StrongTypes\String        A new <String> object.
     */
    public static function fromBytes($value);

    /**
     * Converts a Unicode codepoint (e.g., `\u0041`) to a String object made of the codepoint's value.
     *
     * @param  string                    $value A Unicode codepoint (e.g., `\u0041`).
     * @return Skyzyx\StrongTypes\String        A new <String> object.
     */
    public static function fromUnicode($value);

    /**
     * Sets the minimum allowable length of the string.
     *
     * @param  integer $length The length for this setting.
     * @return self
     */
    public function setMinLength($length);

    /**
     * Sets the maximum allowable length of the string.
     *
     * @param  integer $length The length for this setting.
     * @return self
     */
    public function setMaxLength($length);

    /**
     * Sets the exact allowable length of the string.
     *
     * @param  integer $length The length for this setting.
     * @return self
     */
    public function setExactLength($length);

    /**
     * Gets the length of the value (as determined by the type of string).
     *
     * @return integer The length of the value (as determined by the type of string).
     */
    public function getLength();
}
