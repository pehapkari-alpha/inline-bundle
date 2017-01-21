<?php

/*
 * This file is part of the some package.
 * (c) Jakub Janata <jakubjanata@gmail.com>
 * For the full copyright and license information, please view the LICENSE file.
 */

declare(strict_types = 1);

namespace Pehapkari\InlineEditableBundle\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * @author Jakub Janata <jakubjanata@gmail.com>
 */
abstract class AbstractInlineEnablerSubscriber implements EventSubscriberInterface
{
    /**
     * @return bool
     */
    abstract protected function isAllowedForEditation(): bool;

    /**
     * @param CheckInlinePermissionEvent $event
     */
    public function checkPermission(CheckInlinePermissionEvent $event)
    {
        if ($this->isAllowedForEditation()) {
            $event->setAllowed();
        } else {
            $event->setDisabled();
        }
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [CheckInlinePermissionEvent::CHECK => 'checkPermission'];
    }
}
