<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\GraphQL\Base\Infrastructure;

use OxidEsales\GraphQL\Base\Component\Widget\GraphQL as GraphQLFrontendController;

/**
 * Processes grapqhl requests.
 * This class is initialized from grapqhl.php
 */
class GraphQLControl extends \OxidEsales\Eshop\Core\Base
{
    public function start(): void
    {
        try {
            //Ensures config values are available, database connection is established,
            //session is started, a possible SeoUrl is decoded, globals and environment variables are set.
            $config = $this->getConfig();
            $config->init();

            $view = oxNew(GraphQLFrontendController::class);
            $view->init();

            $config->pageClose();
        } catch (\OxidEsales\Eshop\Core\Exception\SystemComponentException $exception) {
            $this->_handleSystemException($exception);
        } catch (\OxidEsales\Eshop\Core\Exception\CookieException $exception) {
            $this->_handleCookieException($exception);
        } catch (\OxidEsales\Eshop\Core\Exception\DatabaseException $exception) {
            $this->handleDatabaseException($exception);
        } catch (\OxidEsales\Eshop\Core\Exception\StandardException $exception) {
            $this->_handleBaseException($exception);
        }
    }
}
