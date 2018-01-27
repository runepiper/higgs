# Higgs

Higgs is a tiny package to help you with a small project that doesn't need a full fledged framework like Larvel. It has a very basic routing without dynamic parts (yet). It also uses a templating engine called [Fluid]()

## Directory structure

    src (or classes or whatever)
        Controller
            PageController
        Utility
        Service
        ViewHelpers
    resources
        partials
        layouts
        templates
            Controller
                Action.html
            Page (example)
                Index.html
        stylesheets
        javascripts
        images
    config.php
    index.php
    composer.json

## `config.php`
```php
    return [
        'sitename' => 'Hello World',
        'namespace' => '\\Endboss\\',
        'routes' => [
            '/' => [
                'action' => 'index',
                'controller' => 'Page'
            ],
            '/contact' => [
                'action' => 'contact',
                'controller' => 'Page'
            ]
        ]
    ];
```

## `index.php`
```php
    require_once 'vendor/autoload.php';

    $application = new \RP\Higgs\Application();
    $application->boot();
```

## `PageController` (example)
```php
    namespace Endboss\Controller;

    use RP\Higgs\Controller\AbstractBaseController;

    class PageController extends AbstractBaseController
    {
        public function indexAction()
        {
            $this->view->assign('helloWorld', 'Hello World');
        }
```

## Why Higgs?

The [Higgs Boson](https://en.wikipedia.org/wiki/Higgs_boson) also known as the God Particle is an elementary particle in the Standard Model of particle physics. It is smaller than an atomic nucleus and this package has the goal to be as small as possible. Kinda …
