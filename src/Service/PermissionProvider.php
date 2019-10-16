<?php declare(strict_types=1);

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\GraphQL\Service;

use \OxidEsales\GraphQL\Framework\PermissionProviderInterface;

class NamespaceMapper implements PermissionProviderInterface
{
    public function getPermissions(): array
    {
        return [
            'admin' => 'user_get_self'
        ];
    }
}
