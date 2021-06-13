<?php

declare(strict_types=1);

use OpenDocs\CopyrightInfo;
use OpenDocs\EditInfo;

function createDefaultCopyrightInfo()
{
    return new CopyrightInfo(
        'JS Sadness',
        'https://github.com/Danack/JsSadness/blob/main/LICENSE'
    );
}

function createDefaultEditInfo()
{
    return new EditInfo(['Edit page' => 'https://github.com/Danack/EditInfo']);
}

/**
 * Remove the installation directory prefix from a filename
 */
function normaliseFilePath(string $file): string
{
    if (strpos($file, "/var/app/") === 0) {
        $file = substr($file, strlen("/var/app/"));
    }

    return $file;
}

function createJsSadnessEditInfo(string $description, string $file, ?int $line): EditInfo
{
    $path = normaliseFilePath($file);

    $link = 'https://github.com/Danack/JsSadness/blob/main/' . $path;

    if ($line !== null) {
        $link .= '#L' . $line;
    }

    return new EditInfo([$description => $link]);
}