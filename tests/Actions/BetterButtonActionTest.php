<?php

declare(strict_types=1);

namespace UncleCheese\BetterButtons\Tests\Actions;

use SilverStripe\Dev\SapphireTest;
use UncleCheese\BetterButtons\Actions\BetterButtonAction;

final class BetterButtonActionTest extends SapphireTest
{
    /**
     * Test that the button name (or button text) is sanitized and returned as lowercase
     *
     * @dataProvider buttonNameProvider
     */
    public function testGetButtonName(string $buttonName, string $expected): void
    {
        $field = BetterButtonAction::create($buttonName);
        $this->assertSame($expected, $field->getButtonName());
    }

    /**
     * @return array[]
     */
    public function buttonNameProvider(): array
    {
        return [
            [
                'MyGenericButton123',
                'mygenericbutton123'
            ],
            [
                '!@#$%^&*()',
                ''
            ],
            [
                '#better!button#',
                'betterbutton'
            ]
        ];
    }
}
