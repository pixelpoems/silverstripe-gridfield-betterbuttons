<?php

declare(strict_types=1);

namespace UncleCheese\BetterButtons\Buttons;

use UncleCheese\BetterButtons\Buttons\BetterButton_SaveAndAdd;
use UncleCheese\BetterButtons\Interfaces\BetterButton_Versioned;

/**
 * Defines the button that publishes a record, then proceeds to create a new one
 *
 * @author  Uncle Cheese <unclecheese@leftandmain.com>
 * @package  silverstripe-gridfield-betterbuttons
 */
class BetterButton_PublishAndAdd extends BetterButton_SaveAndAdd implements BetterButton_Versioned
{
    /**
     * Builds the button
     */
    public function __construct()
    {
        return parent::__construct('doPublishAndAdd', _t('GridFieldDetailForm.PUBLISHANDADD', 'Publish and add new'));
    }

    /**
     * Determines if the button should display
     */
    public function shouldDisplay(): bool
    {
        $record = $this->gridFieldRequest->record;

        return $record->canEdit() && $record->canCreate();
    }
}
