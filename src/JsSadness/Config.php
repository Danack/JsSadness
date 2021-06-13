<?php

declare(strict_types = 1);

namespace JsSadness;

class Config
{
    const JSSADNESS_ENVIRONMENT = 'jssadness.env';

    const JSSADNESS_ASSETS_FORCE_REFRESH = 'jssadness.assets_force_refresh';

    const JSSADNESS_COMMIT_SHA = 'jssadness.sha';

    /**
     * @param $key
     * @return mixed
     * @throws \Exception
     */
    public static function get($key)
    {
        static $values = null;
        if ($values === null) {
            $values = getGeneratedConfig();
        }

        if (array_key_exists($key, $values) == false) {
            throw new \Exception("No value for " . $key);
        }

        return $values[$key];
    }

    public static function testValuesArePresent(): void
    {
        $rc = new \ReflectionClass(self::class);
        $constants = $rc->getConstants();

        foreach ($constants as $constant) {
            $value = self::get($constant);
        }
    }


    public static function getVersion(): string
    {
        return self::get(self::JSSADNESS_ENVIRONMENT) . "_" . self::get(self::PHPOPENDOCS_COMMIT_SHA);
    }

    public static function getEnvironment(): string
    {
        return self::get(self::JSSADNESS_ENVIRONMENT);
    }

    public static function isProductionEnv(): bool
    {
        if (self::getEnvironment() === App::ENVIRONMENT_LOCAL) {
            return false;
        }

        return true;
    }
}
