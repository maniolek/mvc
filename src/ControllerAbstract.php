<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 * @homepage http://cmf.vegas
 */

namespace Vegas\Mvc;

/**
 * Class ControllerAbstract
 * @package Vegas\Mvc
 */
abstract class ControllerAbstract extends \Phalcon\Mvc\Controller
{
    /**
     * Renders JSON response
     * Disables view
     *
     * @param array|\Phalcon\Http\ResponseInterface $data
     * @return null|\Phalcon\Http\ResponseInterface
     */
    protected function jsonResponse($data = array())
    {
        if ($this->di->has('view')) {
            $view = $this->di->get('view');
            if ($view instanceof \Phalcon\Mvc\View) {
                $view->disable();
            }
        }
        $this->response->setContentType('application/json', 'UTF-8');

        return $this->response->setJsonContent($data);
    }
}