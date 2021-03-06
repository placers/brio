<?php

namespace placer\brio;

use mako\application\Package;

class BrioPackage extends Package
{
    /**
     * Package name.
     *
     * @var string
     */
    protected $packageName = 'placer/brio';

    /**
     * Package namespace.
     *
     * @var string
     */
    protected $fileNamespace = 'brio';

    /**
     * {@inheritdoc}
     */
    protected function bootstrap(): void
    {
        $this->container->get('view')->extend('.html.brio', function ()
        {
            $config = $this->container->get('config');

            $brio = new Brio($config->get('brio::config'));

            return new BrioRenderer($brio);
        });
    }

}
