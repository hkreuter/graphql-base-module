<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\GraphQL\Base\Framework;

use function header;
use function json_encode;

class ResponseWriter implements ResponseWriterInterface
{
    /**
     * Return a JSON Object with the graphql results
     *
     * @codeCoverageIgnore
     *
     * @param mixed[] $result
     */
    public function renderJsonResponse(array $result, int $httpStatus): void
    {
        header('Content-Type: application/json', true, $httpStatus);

        exit(json_encode($result));
    }
}
