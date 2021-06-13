<?php

declare(strict_types=1);

use JsSadness\Config;

$sha = `git rev-parse HEAD`;

if ($sha === null) {
    echo "Failed to read sha from git. Is git installed in container?";
    exit(-1);
}

$sha = trim($sha);


// Default settings
$default = [
    'varnish.pass_all_requests' => false,
    'varnish.allow_non_ssl' => false,
    'system.build_debug_php_containers' => false,
    'php.memory_limit' => getenv('php.memory_limit') ?: '64M',
    'php.web.processes' => 20,
    'php.web.memory' => '24M',
    'php.display_errors' => 'Off',

    'php.post_max_size' => '1M',
    'php.opcache.validate_timestamps' => 0,

    Config::JSSADNESS_ASSETS_FORCE_REFRESH => false,
    Config::JSSADNESS_COMMIT_SHA => $sha,
];

// Settings for local development.
$local = [
    'varnish.pass_all_requests' => true,
    'varnish.allow_non_ssl' => true,
    'system.build_debug_php_containers' => true,

    'php.display_errors' => 'On',
    'php.opcache.validate_timestamps' => 1,

    Config::JSSADNESS_ENVIRONMENT => 'local',
    Config::JSSADNESS_ASSETS_FORCE_REFRESH => true,

    // Domains. Used for generating links back to the platform,
    // e.g. for stripe auth flow.
    // $options['phpopendocs']['app_domain'] = 'http://local.app.jssadness.com';
];

$prod = [
    Config::JSSADNESS_ENVIRONMENT => 'prod',
];

$varnish_debug = [
    'varnish.pass_all_requests' => false
];


