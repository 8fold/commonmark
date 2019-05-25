<?php

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * Original code based on the CommonMark JS reference parser (https://bitly.com/commonmark-js)
 *  - (c) John MacFarlane
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\CommonMark\Tests\functional;

use League\CommonMark\CommonMarkConverter;
use PHPUnit\Framework\TestCase;

class MaximumNestingLevelTest extends TestCase
{
    public function testThatWeCanHitTheLimit()
    {
        $converter = new CommonMarkConverter(['max_nesting_level' => 2]);

        $markdown = '> > Foo';
        $expected = '<blockquote>
<blockquote>
<p>Foo</p>
</blockquote>
</blockquote>
';

        $this->assertEquals($expected, $converter->convertToHtml($markdown));
    }

    public function testThatWeCannotExceedTheLimit()
    {
        $converter = new CommonMarkConverter(['max_nesting_level' => 2]);

        $markdown = '> > > > > > Foo';
        $expected = '<blockquote>
<blockquote>
<p>&gt; &gt; &gt; &gt; Foo</p>
</blockquote>
</blockquote>
';

        $this->assertEquals($expected, $converter->convertToHtml($markdown));
    }
}
