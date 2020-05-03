<?php

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\CommonMark\Tests\Unit\Extension\Table;

use League\CommonMark\Extension\Table\TableRow;
use League\CommonMark\Extension\Table\TableRowRenderer;
use League\CommonMark\Extension\Table\TableSection;
use League\CommonMark\Tests\Unit\Renderer\FakeChildNodeRenderer;
use PHPUnit\Framework\TestCase;

final class TableRowRendererTest extends TestCase
{
    public function testRenderWithTableRow()
    {
        $tableRow = new TableRow();
        $tableRow->data['attributes'] = ['class' => 'foo'];

        $childRenderer = new FakeChildNodeRenderer();
        $childRenderer->pretendChildrenExist();

        $renderer = new TableRowRenderer();

        $this->assertSame('<tr class="foo">::children::</tr>', (string) $renderer->render($tableRow, $childRenderer));
    }

    public function testRenderWithWrongType()
    {
        $this->expectException(\InvalidArgumentException::class);

        (new TableRowRenderer())->render(new TableSection(), new FakeChildNodeRenderer());
    }
}
