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

use idna_convert as Idna;
use UnexpectedValueException;
use Skyzyx\StrongTypes\StringType;

/**
 * Not RFC-valid, but that's on purpose. In general, this validates e-mail addresses against the syntax in
 * RFC 822 (obsolete), with the exceptions that comments and whitespace folding are not supported. Also, IP address
 * hosts are explicitly disallowed.
 *
 * @see http://tools.ietf.org/html/rfc822
 * @see http://tools.ietf.org/html/rfc2822
 * @see http://tools.ietf.org/html/rfc5322
 * @see http://markonphp.com/properly-validate-email-address-php/
 */
class Email extends StringType
{
    /**
     * {@inheritdoc}
     */
    public function validate()
    {
        $idn = new Idna([
            'idn_version' => 2008
        ]);

        $email = $idn->encode($this->value);

        if (!(
            filter_var($email, FILTER_VALIDATE_EMAIL) && // RFC 822 (obsolete). Exceptions: no comments, no whitespace
            preg_match('/@.+\./', $email) &&             // Standard email formatting
            !preg_match('/@\[/', $email) &&              // Disallow IPv6 domains
            !preg_match('/".+@/', $email) &&             // Disallow quotes
            !preg_match('/=.+@/', $email) &&             // Disallow equals
            !preg_match('/localhost/i', $email) &&       // Disallow localhost
            !preg_match('/localdomain/i', $email)        // Disallow localdomain
        )) {
            throw new UnexpectedValueException(
                sprintf('The value "%s" is not a valid email address.', $this->value)
            );
        }
    }
}
