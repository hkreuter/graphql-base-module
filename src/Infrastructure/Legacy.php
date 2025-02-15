<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\GraphQL\Base\Infrastructure;

use Exception;
use OxidEsales\Eshop\Application\Model\User as UserModel;
use OxidEsales\Eshop\Core\Email;
use OxidEsales\Eshop\Core\Model\ListModel as EshopListModel;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\UtilsObject;
use OxidEsales\EshopCommunity\Internal\Transition\Utility\ContextInterface;
use OxidEsales\EshopCommunity\Internal\Utility\Email\EmailValidatorServiceInterface as EhopEmailValidator;
use OxidEsales\GraphQL\Base\DataType\User;
use OxidEsales\GraphQL\Base\Exception\InvalidLogin;

/**
 * @codeCoverageIgnore - Remove when integration tests are added to the coverage report
 */
class Legacy
{
    public function __construct(
        private readonly ContextInterface $context,
        private readonly EhopEmailValidator $emailValidator
    ) {
    }

    /**
     * @throws InvalidLogin
     */
    public function login(?string $username = null, ?string $password = null): User
    {
        $user = $this->getUserModel();

        if ($username && $password) {
            try {
                $user->login($username, $password);
            } catch (Exception) {
                // TODO: Not every exception is an invalid password
                throw new InvalidLogin('Username/password combination is invalid');
            }
            return new User($user, false);
        }

        $user->setId(self::createUniqueIdentifier());
        return new User($user, true);
    }

    public function getUserModel(?string $userId = null): UserModel
    {
        $userModel = oxNew(UserModel::class);

        if ($userId) {
            $userModel->load($userId);
        }

        return $userModel;
    }

    public function getConfigParam(string $param): mixed
    {
        return Registry::getConfig()->getConfigParam($param);
    }

    public function getShopUrl(): string
    {
        return Registry::getConfig()->getShopUrl();
    }

    public function getShopId(): int
    {
        return $this->context->getCurrentShopId();
    }

    public function getLanguageId(): int
    {
        $requestParameter = $_GET['lang'];

        if ($requestParameter === null) {
            return (int)Registry::getLang()->getBaseLanguage();
        }

        return (int)$requestParameter;
    }

    public function isValidEmail(string $email): bool
    {
        return $this->emailValidator->isEmailValid($email);
    }

    public function getEmail(): Email
    {
        return oxNew(Email::class);
    }

    /**
     * @return string[]
     */
    public function getUserGroupIds(?string $userId): array
    {
        if (!$userId) {
            return [];
        }

        $user = $this->getUserModel($userId);

        if (!$user->isLoaded()) {
            return ['oxidanonymous'];
        }

        /** @var EshopListModel $userGroupList */
        $userGroupList = $user->getUserGroups();

        $userGroupIds = [];

        foreach ($userGroupList->getArray() as $group) {
            $userGroupIds[] = (string)$group->getId();
        }

        return $userGroupIds;
    }

    public static function createUniqueIdentifier(): string
    {
        $utils = Registry::getUtilsObject();
        return $utils->generateUId();
    }
}
