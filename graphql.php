<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

require_once (__DIR__ . '/../../../bootstrap.php');

//Starts the shop for graphql
\OxidEsales\GraphQL\Base\Infrastructure\Oxid::runGraphQL();
