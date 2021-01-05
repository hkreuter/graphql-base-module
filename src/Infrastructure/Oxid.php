<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\GraphQL\Base\Infrastructure;

/**
 * Static class mostly containing static methods which are supposed to be called before the full framework initialization
 */
class Oxid
{
    /**
     * Executes grapqhl shop controller
     *
     * @static
     */
    public static function runGraphQL()
    {
        /** @var GraphQlControl $graphQLControl */
        $graphQLControl = oxNew(\OxidEsales\GraphQL\Base\Infrastructure\GraphQLControl::class);

        return $graphQLControl->start();
    }
}
