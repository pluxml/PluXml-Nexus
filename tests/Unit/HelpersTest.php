<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class HelpersTest extends TestCase
{
    public function testEscapeHtmlEscapesQuotesAndTags(): void
    {
        self::assertSame(
            '&lt;script&gt;alert(&quot;x&quot;)&lt;/script&gt;',
            escape_html('<script>alert("x")</script>')
        );
    }

    public function testEscapeHtmlCastsScalarValues(): void
    {
        self::assertSame('42', escape_html(42));
        self::assertSame('', escape_html(null));
    }

    public function testSafeUrlAllowsHttpAndHttpsOnly(): void
    {
        self::assertSame('https://example.test/a?b=1', safe_url('https://example.test/a?b=1'));
        self::assertSame('HTTP://example.test', safe_url('HTTP://example.test'));
        self::assertSame('', safe_url('javascript:alert(1)'));
        self::assertSame('', safe_url('data:text/html,<script>'));
        self::assertSame('', safe_url('/relative/path'));
    }
}
