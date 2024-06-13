<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\GraphQL\Base\Framework;

use GraphQL\Error\Error;

interface GraphQLQueryHandlerInterface
{
    public function executeGraphQLQuery(): void;

    /**
     * @deprecated Exceptions should be thrown instead of using this method
     */
    public static function addError(Error $error): void;
}
