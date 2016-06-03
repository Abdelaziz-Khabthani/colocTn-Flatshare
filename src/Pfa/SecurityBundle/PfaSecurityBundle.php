<?php

namespace Pfa\SecurityBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PfaSecurityBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
