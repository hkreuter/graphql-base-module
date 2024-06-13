<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\GraphQL\Base\Framework;

use function header;
use function json_encode;

interface ResponseWriterInterface
{
    /**
     * Return a JSON Object with the graphql results
     *
     * @codeCoverageIgnore
     * @SuppressWarnings(PHPMD.ExitExpression)
     *
     * @param mixed[] $result
     */
    public function renderJsonResponse(array $result): void;

}
