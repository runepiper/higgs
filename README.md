# Higgs

Higgs is a tiny package to help you with a small project that doesn't need a full fledged framework like Larvel. It has a very basic routing without dynamic parts (yet). It also uses a templating engine called [Fluid](https://github.com/TYPO3/Fluid).

## `composer.json`
```JSON
{
    "require": {
        "rp/higgs": "dev-master"
    },
    "autoload": {
        "psr-4": {
            "App\\": "app/"
        }
    }
}
```

## Getting started

After you created a `composer.json` file and installed the dependencies you can execute `./vendor/bin/higgs` to set up an example `config.php`, `.htaccess` and create an empty `app/` directory for your controllers and so on.

## Directory structure
```
    app
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
```

## `index.php`
```php
require_once 'vendor/autoload.php';

$application = new \RP\Higgs\Application();
$application->boot();
```

## `PageController` (example)
```php
namespace App\Controller;

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
