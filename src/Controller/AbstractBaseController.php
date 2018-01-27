<?php

namespace RP\Higgs\Controller;

use RP\Higgs\Utility\ConfigUtility;
use TYPO3Fluid\Fluid\View\TemplateView;

abstract class AbstractBaseController
{
    /**
     * @var array
     */
    protected $arguments = [];

    /**
     * @var array
     */
    protected $config = [];

    /**
     * @var TemplateView
     */
    protected $view;

    public function __construct($arguments) {
        $this->arguments = $arguments;
        $this->config = ConfigUtility::load();
        $this->initializeTemplateEngine();
    }

    protected function initializeTemplateEngine()
    {
        $this->view = new TemplateView();

        $paths = $this->view->getTemplatePaths();
        $paths->setTemplateRootPaths([
            'resources/views/templates'
        ]);
        $paths->setLayoutRootPaths([
            'resources/views/layouts'
        ]);
        $paths->setPartialRootPaths([
            'resources/views/partials'
        ]);

        $renderingContext = $this->view->getRenderingContext();
        $renderingContext->setControllerName($this->arguments['controller']);
        $renderingContext->setControllerAction($this->arguments['action']);
        $renderingContext->getViewHelperResolver()->addNamespace('rp', 'RP\\Higgs\\ViewHelpers');

        $this->view->assign('pageTitle', $this->config['sitename']);
    }

    public function __destruct()
    {
        echo $this->view->render();
    }
}
