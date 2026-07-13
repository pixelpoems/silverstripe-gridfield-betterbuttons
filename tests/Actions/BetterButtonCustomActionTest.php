<?php

declare(strict_types=1);

namespace UncleCheese\BetterButtons\Tests\Actions;

use SilverStripe\Dev\SapphireTest;
use UncleCheese\BetterButtons\Actions\BetterButtonCustomAction;

final class BetterButtonCustomActionTest extends SapphireTest
{
    private BetterButtonCustomAction $button;

    /**
     * Instantiate the test button
     *
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->button = BetterButtonCustomAction::create('foo', 'bar');
    }

    /**
     * Test that setRedirectType will throw an exception if you provide an unrecognised redirect type
     *
     * @expectedException Exception
     * @expectedExceptionMessage Redirect type must use either the GOBACK or REFRESH constants
     * on BetterButtonCustomAction
     */
    public function testSetRedirectThrowsExceptionOnInvalidType(): void
    {
        $this->button->setRedirectType(12345);
    }

    /**
     * Test that a valid redirect type can be set and retrieved
     */
    public function testSetAndGetRedirectType(): void
    {
        $this->button->setRedirectType(BetterButtonCustomAction::REFRESH);
        $this->assertSame(BetterButtonCustomAction::REFRESH, $this->button->getRedirectType());
    }

    /**
     * Test that the redirect URL can be set and retrieved
     */
    public function testSetAndGetRedirectUrl(): void
    {
        $this->button->setRedirectURL('leftandmain.com');
        $this->assertSame('leftandmain.com', $this->button->getRedirectURL());
    }
}
