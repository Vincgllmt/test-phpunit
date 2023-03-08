<?php

declare(strict_types=1);

namespace Slug;

class Slugger
{
    public function slugify(string $text): string
    {
        $text = html_entity_decode(strip_tags($text));
        $text = transliterator_transliterate('Any-Latin; Latin-ASCII;', $text);
        $text = preg_replace('/[^0-9a-zA-Z]+/', '-', $text);
        $text = trim($text, "-");
        $text = mb_strtolower($text);
        return $text;
    }
}
