<?php

declare(strict_types = 1);

namespace JsSadness;

/**
 * Mostly used for app wide constants.
 */
class App
{
    const DATE_TIME_FORMAT = 'Y_m_d_H_i_s';

    const DATE_TIME_EXACT_FORMAT = "Y-m-d\TH:i:s.uP";

    const DATE_TIME_FORMAT_READABLE = 'Y/m/d g:i a';

    const YAY_PAGE_OK = '<!-- yay, page is done. -->';

    const ERROR_CAUGHT_BY_MIDDLEWARE_MESSAGE = "<!-- This is caught in the exception mapper -->";

    const ERROR_CAUGHT_BY_MIDDLEWARE_API_MESSAGE = "Correctly caught DebuggingCaughtException";

    const ERROR_CAUGHT_BY_ERROR_HANDLER_MESSAGE = "<!-- This is caught in the AppErrorHandler -->";

    const ERROR_CAUGHT_BY_ERROR_HANDLER_API_MESSAGE = "This is caught in the AppErrorHandler";

    public const ENVIRONMENT_LOCAL = 'local';

    public const ENVIRONMENT_PROD = 'prod';

    public static function getAssetSuffix()
    {
        $forcesRefresh = Config::get(\JsSadness\Config::JSSADNESS_ASSETS_FORCE_REFRESH);

        if ($forcesRefresh) {
            return '?time=' . time();
        }

        $sha = Config::get(\JsSadness\Config::JSSADNESS_COMMIT_SHA);

        return "?version=" . $sha;
    }
}
