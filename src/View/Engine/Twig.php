<?php
/**
 * Seaf: Simple Easy Acceptable micro-framework.
 *
 * クラスを定義する
 *
 * @author HAjime MATSUMOTO <mail@hazime.org>
 * @copyright Copyright (c) 2014, Seaf
 * @license   MIT, http://seaf.hazime.org
 */

namespace Seaf\View\Engine;

use Seaf;
use Seaf\Core\Environment\EnvironmentAcceptableIF;
use Seaf\Core\Environment\Environment;
use Seaf\View\View;

/**
 * ビューエンジン For Twig
 */
class Twig extends Environment
{
    /**
     */
    private $view;
    private $twig;

    public function __construct (View $view) 
    {
        $loader = new \Twig_Loader_Filesystem(
            $view->config()->getf('{{root.path}}/{{view.path}}')
        );
        $twig   = new \Twig_Environment(
            $loader,
            array('cache' => $view->config()->getf('{{root.path}}/{{cache.path}}'))
        );

        if(Seaf::getEnvMode()  != Seaf::ENV_PRODUCTION )
        {
            $twig->clearcachefiles();
        }

        $this->twig = $twig;
        $this->view = $view;
    }

    public function getTemplateFileName ($name)
    {
        return $name.'.twig';
    }

    public function render ($name, $params = array())
    {
        $file = $this->getTemplateFileName($name);
        return $this->twig->render($file, $params);
    }
}

/* vim: set expandtab ts=4 sw=4 sts=4: et*/
