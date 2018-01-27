<?php

namespace RP\Higgs\ViewHelpers;

use RP\Higgs\Utility\ConfigUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

class LinkViewHelper extends AbstractTagBasedViewHelper
{
    /**
     * @var string
     */
    protected $tagName = 'a';

    /**
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('action', 'string', 'Action to be called');
        $this->registerArgument('controller', 'string', 'Controller to be called');
        $this->registerArgument('absolute', 'bool', 'Wether the URL should be absolute or not', false);
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $config = ConfigUtility::load();

        foreach ($config['routes'] as $uri => $routeConfig) {
            if ($routeConfig['action'] === $this->arguments['action'] && $routeConfig['controller'] === $this->arguments['controller']) {
                if ((bool)$this->arguments['absolute'] === true) {
                    $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . str_replace('index.php', '', $_SERVER['PHP_SELF']);
                    $baseUrl = substr($baseUrl, 0, -1);
                    $uri = $baseUrl . $uri;
                }

                $this->tag->addAttribute('href', $uri);
                break;
            }
        }

        $this->tag->setContent($this->renderChildren());

        return $this->tag->render();
    }
}