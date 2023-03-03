<?php

declare(strict_types=1);

namespace Tests\Slug;

use PHPUnit\Framework\TestCase;
use Slug\Slugger;

class SluggerTest extends TestCase
{
    /**
     * @dataProvider providerSlugify
     */
    public function testSlugify(string $subject, string $expected): void
    {
        $slugger = new Slugger();
        $this->assertSame($expected, $slugger->slugify($subject), "«{$subject}»\nshould be slugified to\n«{$expected}»");
    }

    protected function providerSlugify(): array
    {
        return [
            'identity' => [
                'abcdef',
                'abcdef',
            ],
            'html tags stripping' => [
                '<em>abcdef</em>',
                'abcdef',
            ],
            'more html tags stripping' => [
                '<em>abc</em>de<a href="about:blank"><code>f</code></a>',
                'abcdef',
            ],
            'html entities conversion' => [
                'a &laquo;b&raquo;c&nbsp;def',
                'a-b-c-def',
            ],
            'html entities conversion and tags removal' => [
                'a &laquo;b&raquo;c&nbsp;de<span class="code">f</span>',
                'a-b-c-def',
            ],
            'french characters transliteration' => [
                'àbçdéf',
                'abcdef',
            ],
            'single special character conversion' => [
                'a{b-c_d@e^f',
                'a-b-c-d-e-f',
            ],
            'emoji conversion' => [
                '😠 ab - 😓 - cd 😕 ef',
                'ab-cd-ef',
            ],
            'multiple special characters conversion' => [
                "a b~|`c-d$\t \ne%:.,f",
                'a-b-c-d-e-f',
            ],
            'leading and trailing special characters removal' => [
                "\n \t#_{a b~|`c-d$%e:.,f*^\t\n    ",
                'a-b-c-d-e-f',
            ],
            'case conversion' => [
                'aBcDEf',
                'abcdef',
            ],
            'full example' => [
                "😠#[ A &laquo;b\n \t\t&raquo;^&quot;&apos;^<em>Ç&nbsp;d</em><b>&Eacute;</b><div><span class='code'>f</span> %*</div>",
                'a-b-c-def',
            ],
        ];
    }
}
