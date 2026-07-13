<?php

declare(strict_types=1);

namespace UncleCheese\BetterButtons\Tests\Extensions\Stubs;

use SilverStripe\Dev\TestOnly;
use SilverStripe\ORM\DataObject;
use UncleCheese\BetterButtons\Extensions\BetterButtonDataObject;

/**
 * A mock DataObject that has the BetterButtonDataObject extension applied, for testing
 */
class ButtonDataObject extends DataObject implements TestOnly
{
    private static string $table_name = 'TestButtonDataObject';

    private static array $extensions = [
        BetterButtonDataObject::class
    ];
}
