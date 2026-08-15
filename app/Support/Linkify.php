<?php

namespace App\Support;

use Illuminate\Support\HtmlString;

/**
 * Turns plain-text URLs, email addresses, and phone numbers into clickable
 * links, without ever treating the source text as HTML.
 *
 * Program descriptions (see Usctdp_Build_Program_Schedule) are plain text
 * typed by admins into the plugin's product editor - there's no WYSIWYG/HTML
 * in play, and we don't want one: rendering admin-entered text as raw HTML
 * would be an XSS hole the moment someone pastes something unexpected in.
 *
 * So the whole string is escaped *first*, and link detection runs against
 * the already-escaped text, splicing <a> tags around the matches. Because
 * urls/emails/phone numbers can't contain characters that escaping would
 * alter, this ordering can't be used to smuggle markup back in - unlike
 * escaping *after* linkifying, which would corrupt (or defeat, if done
 * wrong) the tags just inserted.
 */
class Linkify
{
    private const PATTERN = '/
        (?<email>[\w.+-]+@[\w-]+\.[a-zA-Z]{2,})
        |(?<url>https?:\/\/[^\s<]+)
        |(?<phone>\(?\d{3}\)?[-.\s]\d{3}[-.\s]\d{4})
    /xi';

    /**
     * @param  string|null  $text  Raw, untrusted plain text.
     */
    public static function html(?string $text): HtmlString
    {
        $escaped = htmlspecialchars($text ?? '', ENT_QUOTES, 'UTF-8');
        $escaped = nl2br($escaped);

        $linked = preg_replace_callback(self::PATTERN, function ($m) {
            if ($m['email'] !== '') {
                return sprintf('<a href="mailto:%1$s">%1$s</a>', $m['email']);
            }
            if ($m['url'] !== '') {
                return self::linkifyUrl($m['url']);
            }
            return self::linkifyPhone($m['phone']);
        }, $escaped);

        return new HtmlString($linked);
    }

    private static function linkifyUrl(string $url): string
    {
        // Trailing punctuation almost never belongs to the URL itself (e.g.
        // "see https://example.com." at the end of a sentence) - strip it
        // from the link but leave it in the surrounding text.
        $trail = '';
        if (preg_match('/[.,;:!?]+$/', $url, $m)) {
            $trail = $m[0];
            $url = substr($url, 0, -strlen($trail));
        }

        return sprintf(
            '<a href="%1$s" target="_blank" rel="noopener noreferrer">%1$s</a>%2$s',
            $url,
            $trail
        );
    }

    private static function linkifyPhone(string $phone): string
    {
        $digits = preg_replace('/\D/', '', $phone);

        return sprintf('<a href="tel:+1%s">%s</a>', $digits, $phone);
    }
}
