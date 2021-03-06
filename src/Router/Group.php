<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 * @homepage http://cmf.vegas
 */

namespace Vegas\Mvc\Router;

use Phalcon\Di\InjectionAwareInterface;
use Vegas\Di\InjectionAwareTrait;

/**
 * Class Group
 *
 * @method \Vegas\Mvc\Router\Route addGet($pattern, $paths = null)
 * @method \Vegas\Mvc\Router\Route addPost($pattern, $paths = null)
 * @method \Vegas\Mvc\Router\Route addDelete($pattern, $paths = null)
 * @method \Vegas\Mvc\Router\Route addPatch($pattern, $paths = null)
 * @method \Vegas\Mvc\Router\Route addPut($pattern, $paths = null)
 * @method \Vegas\Mvc\Router\Route addOptions($pattern, $paths = null)
 * @method \Vegas\Mvc\Router\Route addHead($pattern, $paths = null)
 * 
 * @package Vegas\Mvc\Router
 *
 * @codeCoverageIgnore
 */
class Group extends \Phalcon\Mvc\Router\Group implements InjectionAwareInterface
{
    use InjectionAwareTrait;

    use PluginCollectorTrait;

    /**
     * Adds a route applying the common attributes
     */
    protected function _addRoute($pattern, $paths = null, $httpMethods = null)
    {
        /**
         * Check if the paths need to be merged with current paths
         */
        $defaultPaths = $this->_paths;

        if (is_array($defaultPaths)) {

            if (is_string($paths)) {
                $processedPaths = Route::getRoutePaths($paths);
            } else {
                $processedPaths = $paths;
            }

            if (is_array($processedPaths)) {
                /**
                 * Merge the paths with the default paths
                 */
                $mergedPaths = array_merge($defaultPaths, $processedPaths);
            } else {
                $mergedPaths = $defaultPaths;
            }
        } else {
            $mergedPaths = $paths;
        }

        /**
         * Every route is internally stored as a Phalcon\Mvc\Router\Route
         */
        $route = new Route($this->_prefix . $pattern, $mergedPaths, $httpMethods);
        $route->setDI($this->getDI());
        $this->_routes[] = $route;

        $route->setGroup($this);
        return $route;
    }
}