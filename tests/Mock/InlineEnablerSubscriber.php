<?php

/*
 * This file is part of the some package.
 * (c) Jakub Janata <jakubjanata@gmail.com>
 * For the full copyright and license information, please view the LICENSE file.
 */

declare(strict_types = 1);

namespace Pehapkari\InlineEditableBundle\Tests\Mock;

use Pehapkari\InlineEditableBundle\Event\AbstractInlineEnablerSubscriber;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * @author Jakub Janata <jakubjanata@gmail.com>
 */
class InlineEnablerSubscriber extends AbstractInlineEnablerSubscriber
{
    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * @return bool
     */
    protected function isAllowedForEditation(): bool
    {
        return $this->authorizationChecker->isGranted('ROLE_ADMIN');
    }
}
