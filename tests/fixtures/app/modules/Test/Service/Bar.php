<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 * @homepage http://cmf.vegas
 */

namespace Test\Service;

use Phalcon\DI\InjectionAwareInterface;
use Vegas\Di\InjectionAwareTrait;

class Bar implements InjectionAwareInterface
{
    use InjectionAwareTrait;

    /**
     * @var InjectorFoo
     * @inject(class=\Test\Service\InjectorFoo)
     */
    public $fooService;

    public function initialize()
    {

    }

    public function bar()
    {
        echo 1;
    }
}