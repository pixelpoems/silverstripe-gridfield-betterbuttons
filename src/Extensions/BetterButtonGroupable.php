<?php

declare(strict_types=1);

namespace UncleCheese\BetterButtons\Extensions;

use SilverStripe\Core\Extension;

/**
 * Injects the "isGrouped" flag into Actions and Buttons
 *
 * @author Uncle Cheese <unclecheese@leftandmain.com>
 */
class BetterButtonGroupable extends Extension
{
    public $owner;

    /**
     * Is the button part of a group, e.g. DropdownFormAction
     * @var boolean
     */
    protected $isGrouped = false;

    /**
     * Getter for the $isGrouped bool
     * @return boolean
     */
    public function isGrouped()
    {
        return $this->isGrouped;
    }

    /**
     * Sets the $isGrouped flag
     * @param bool $bool
     */
    public function setIsGrouped($bool)
    {
        $this->isGrouped = $bool;

        return $this->getOwner();
    }
}
