<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\GraphQL\Base\Framework;

use OxidEsales\Eshop\Core\ConfigFile;
use OxidEsales\Eshop\Core\Registry;

class Config extends Config_parent
{
    /**
     * Disable creating of session
     */
    public function _getShopIdFromSession()
    {
        $request = Registry::getRequest();
        //todo: additional check if it is graphql request
        if($request->getRequestParameter('skipSession')) {
            Registry::get(ConfigFile::class)->setVar('blDeprecatedSubshopsInSessions', true);
        }

        parent::_getShopIdFromSession();
    }
}
