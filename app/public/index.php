<?php

declare(strict_types=1);

require_once __DIR__ . "/../../vendor/autoload.php";
require __DIR__ . "/../../config.generated.php";



use OpenDocs\Page;

$page = Page::createFromHtml(
    'index',
    "I am the happy fun time content",
    null
);

echo createPageHtml(null, $page);

