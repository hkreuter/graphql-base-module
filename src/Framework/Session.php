<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\GraphQL\Base\Framework;

use OxidEsales\Eshop\Core\Registry;

class Session extends Session_parent
{
    //todo: set/get variable must be used if we need _SESSION to be empty
//    private $session = [];
//
//    public function setVariable($name, $value)
//    {
//        $request = Registry::getRequest();
//        if($request->getRequestParameter('cl') !== 'graphql') {
//            return parent::setVariable($name, $value);
//        }
//
//        $this->session[$name] = $value;
//    }
//
//    public function getVariable($name)
//    {
//        $request = Registry::getRequest();
//        if($request->getRequestParameter('cl') !== 'graphql') {
//            return parent::getVariable($name);
//        }
//
//        return isset($this->session[$name]) ? $this->session[$name] : null;
//    }
}
