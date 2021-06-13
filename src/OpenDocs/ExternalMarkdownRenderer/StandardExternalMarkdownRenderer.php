<?php

declare(strict_types = 1);

namespace OpenDocs\ExternalMarkdownRenderer;

use OpenDocs\MarkdownRenderer\MarkdownRenderer;

use OpenDocs\UrlFetcher\UrlFetcher;

class StandardExternalMarkdownRenderer implements ExternalMarkdownRenderer
{
    private UrlFetcher $urlFetcher;

    private MarkdownRenderer $markdownRenderer;

    public function __construct(UrlFetcher $urlFetcher, MarkdownRenderer $markdownRenderer)
    {
        $this->urlFetcher = $urlFetcher;
        $this->markdownRenderer = $markdownRenderer;
    }

    public function renderUrl(string $url): string
    {
        $markdown = $this->urlFetcher->getUrl($url);
        return $this->markdownRenderer->render($markdown);
    }
}
