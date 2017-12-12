<?php

namespace App\Support;

use Exception;

class Resolver
{
    /**
     * Resolves model class name using its shortcut.
     *
     * @param string $shortClassName
     * @param $prefix
     * @param string $suffix
     * @return bool|string
     * @throws Exception
     */
    public static function getFullClassName($shortClassName, $prefix = '', $suffix = '')
    {
        $className = static::checkClass('\\App\\' . $prefix . studly_case($shortClassName) . $suffix);

        if (! $className) {
            throw new Exception("There is no definition for $shortClassName");
        }

        return $className;
    }

    /**
     * Resolves model class name using its shortcut.
     *
     * @param string $shortClassName
     * @return bool|string
     */
    public static function resolveModelClass($shortClassName)
    {
        return static::getFullClassName($shortClassName);
    }

    /**
     * Resolves model repository interface name using its shortcut.
     *
     * @param string $shortInterfaceName
     * @return bool|string
     */
    public static function resolveModelRepositoryClass($shortInterfaceName)
    {
        return static::getFullClassName($shortInterfaceName, 'Repositories\\Models\\', 'Repository');
    }

    /**
     * Resolves request class name using its shortcut.
     *
     * @param string $shortClassName
     * @return bool|string
     */
    public static function resolveRequestClass($shortClassName)
    {
        return static::getFullClassName($shortClassName, 'Http\\Requests\\', 'Request');
    }

    /**
     * Resolves resource class name using its shortcut.
     *
     * @param string $shortClassName
     * @return bool|string
     */
    public static function resolveResourceClass($shortClassName)
    {
        return static::getFullClassName($shortClassName, 'Http\\Resources\\', 'Resource');
    }

    /**
     * Checks if the given class exists.
     *
     * @param string $fullyQualifiedName
     * @return bool|string
     */
    public static function checkClass($fullyQualifiedName)
    {
        if (class_exists($fullyQualifiedName)) {
            return $fullyQualifiedName;
        }

        return false;
    }
}
