<?php

/*
 * This file is part of the league/commonmark-ext-smartpunct package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * Original code based on the CommonMark JS reference parser (http://bitly.com/commonmark-js)
 *  - (c) John MacFarlane
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\CommonMark\Ext\SmartPunct\Tests;

use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Ext\SmartPunct\Quote;
use League\CommonMark\Ext\SmartPunct\QuoteRenderer;
use League\CommonMark\Inline\Element\Text;
use PHPUnit\Framework\TestCase;

/**
 * Tests the quote renderer
 */
final class QuoteRendererTest extends TestCase
{
    /** @var QuoteRenderer */
    private $renderer;

    /** @var ElementRendererInterface */
    private $htmlRenderer;

    protected function setUp()
    {
        $this->renderer = new QuoteRenderer();
        $this->htmlRenderer = $this->createMock(ElementRendererInterface::class);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidInlineType()
    {
        $inline = $this->createMock(Text::class);

        $this->renderer->render($inline, $this->htmlRenderer);
    }

    /**
     * @param string $character
     * @param string $expected
     *
     * @dataProvider dataForTestRender
     */
    public function testRender(string $character, string $expected)
    {
        $inline = new Quote($character);

        $this->assertEquals($expected, $this->renderer->render($inline, $this->htmlRenderer));
    }

    public function dataForTestRender()
    {
        // Single-quotes should render as an apostrophe
        yield ["'", "’"];

        // Double-quotes should render as an opening quote
        yield ['"', '“'];

        // Already-stylized quotes should be rendered as-is
        yield ["’", "’"];
        yield ['“', '“'];
    }
}
