<?php

namespace Application\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
// use Zend\Config\Config;

class MailerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // $config = new Config($container->get('Config'));
        $mailgun = $container->get('Mailgun');

        return new Mailer($mailgun);
    }
}

