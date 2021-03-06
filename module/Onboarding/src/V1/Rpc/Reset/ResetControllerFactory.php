<?php

namespace Onboarding\V1\Rpc\Reset;

use Application\Service\Mailer;

class ResetControllerFactory
{
    public function __invoke($container)
    {
        return new ResetController(
            $container->get('doctrine.entitymanager.orm_default'),
            $container->get(Mailer::class)
        );
    }
}
