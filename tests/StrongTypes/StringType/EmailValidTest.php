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

namespace Skyzyx\Tests\StrongTypes\StringType;

use Skyzyx\StrongTypes\StringType\Email;

/**
 * @see http://codefool.tumblr.com/post/15288874550/list-of-valid-and-invalid-email-addresses
 * @see https://svn.apache.org/viewvc/commons/proper/validator/trunk/src/test/java/org/apache/commons/validator/EmailTest.java?view=markup
 */
class EmailValidTest extends \PHPUnit_Framework_TestCase
{
    public function listEmails()
    {
        return [
            ["*@example.net"],
            ["---@example.com"],
            ["abigail@example.com"],
            ["andy-noble@data-workshop.c-om"],
            ["andy-noble@data-workshop.co-m"],
            ["andy.noble@data-workshop.com"],
            ["andy.o'reilly@data-workshop.com"],
            ["foo+bar@i.am.not.in.us.example.com"],
            ["foo-bar@example.net"],
            ["fred&barny@example.com"],
            ["joe!@apache.org"],
            ["joe%45@apache.org"],
            ["joe&@apache.org"],
            ["joe'@apache.org"],
            ["joe*@apache.org"],
            ["joe+@apache.org"],
            ["joe-@apache.org"],
            ["joe1blow@apache.org"],
            ["joe\$blow@apache.org"],
            ["joe_@apache.org"],
            ["jsmith@apache.c"],
            ["jsmith@apache.com"],
            ["jsmith@apache.info"],
            ["jsmith@apache.net"],
            ["jsmith@apache.org"],
            ["someone@yahoo.com"],
            ["someone@yahoo.mu-seum"],
            ["someone@yahoo.museum"],
            ["sub-net.mailbox@sub-domain.domain"],
            ['!def!xyz%abc@example.com'],
            ['!def!xyz%abc@iana.org'],
            ['$A12345@example.com'],
            ['$A12345@iana.org'],
            ['+1~1+@iana.org'],
            ['+@b.c'],
            ['+@b.com'],
            ['1234567890@example.com'],
            ['1234567890@iana.org'],
            ['_______@example.com'],
            ['_somename@example.com'],
            ['_somename@iana.org'],
            ['_Yosemite.Sam@example.com'],
            ['_Yosemite.Sam@iana.org'],
            ['a-b@bar.com'],
            ['a@b.co-foo.uk'],
            ['a@bar.com'],
            ['customer/department@example.com'],
            ['customer/department@iana.org'],
            ['dclo@us.ibm.com'],
            ['email@example-one.com'],
            ['email@example.co.jp'],
            ['email@example.com'],
            ['email@example.museum'],
            ['email@example.name'],
            ['email@example.web'],
            ['email@subdomain.example.com'],
            ['first.last@123.iana.org'],
            ['first.last@3com.com'],
            ['first.last@iana.org'],
            ['firstname+lastname@example.com'],
            ['firstname-lastname@example.com'],
            ['firstname.lastname@example.com'],
            ['Ima.Fool@example.com'],
            ['Ima.Fool@iana.org'],
            ['name.lastname@domain.com'],
            ['peter.piper@iana.org'],
            ['shaitan@my-domain.thisisminekthx'],
            ['t*est@iana.org'],
            ['test+test@iana.org'],
            ['test-test@iana.org'],
            ['test.test@iana.org'],
            ['test@123.123.123.x123'],
            ['test@Bücher.ch'],
            ['test@example.example.iana.org'],
            ['test@example.iana.org'],
            ['test@iana.org'],
            ['TEST@iana.org'],
            ['test@test.com'],
            ['test@xn--example.com'],
            ['user%uucp!path@berkeley.edu'],
            ['user+mailbox@iana.org'],
            ['valid@about.museum'],
            ['x@x23456789.x23456789.x23456789.x23456789.x23456789.x23456789.x23456789.x23456789.x23456789.x23456789.x23456789.x23456789.x23456789.x23456789.x23456789.x23456789.x23456789.x23456789.x23456789.x23456789.x23456789.x23456789.x23456789.x23456789.x23456789.x2'],
            ['{_test_}@iana.org'],
            ['~@example.com'],
            ['~@iana.org'],
            ['あいうえお@example.com'],
        ];
    }

    /**
     * @dataProvider listEmails
     */
    public function testValidate($email)
    {
        $this->assertTrue(true);
        new Email($email);
    }
}
