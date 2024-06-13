<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\GraphQL\Base\Framework;

use Lcobucci\JWT\UnencryptedToken;

interface RequestReaderInterface
{
    /**
     * Returns the encoded token from the authorization header
     *
     * @throws InvalidToken
     */
    public function getAuthToken(): ?UnencryptedToken;

    /**
     * Get the Request data
     *
     * @return array{query: string, variables: string[], operationName: string}
     */
    public function getGraphQLRequestData(string $inputFile = 'php://input'): array;
}
