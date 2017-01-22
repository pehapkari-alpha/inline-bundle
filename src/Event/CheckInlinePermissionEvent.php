<?php

/*
 * This file is part of the some package.
 * (c) Jakub Janata <jakubjanata@gmail.com>
 * For the full copyright and license information, please view the LICENSE file.
 */

declare(strict_types = 1);

namespace Pehapkari\InlineEditableBundle\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * @author Jakub Janata <jakubjanata@gmail.com>
 */
class CheckInlinePermissionEvent extends Event
{
    /**
     * Event name (for dispatching)
     */
    const CHECK = 'inline_editable_permission_check';

    /**
     * @var bool
     */
    private $editationAllowed;

    /**
     * @param bool $editationAllowed
     */
    public function __construct(bool $editationAllowed = false)
    {
        $this->editationAllowed = $editationAllowed;
    }

    /**
     *
     */
    public function setAllowed()
    {
        $this->editationAllowed = true;
    }

    /**
     *
     */
    public function setDisabled()
    {
        $this->editationAllowed = false;
    }

    /**
     * @return bool
     */
    public function isAllowed(): bool
    {
        return $this->editationAllowed;
    }
}
