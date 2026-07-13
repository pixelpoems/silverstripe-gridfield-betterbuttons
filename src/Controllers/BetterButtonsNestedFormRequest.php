<?php

declare(strict_types=1);

namespace UncleCheese\BetterButtons\Controllers;

use SilverStripe\ORM\FieldType\DBHTMLText;
use Exception;
use SilverStripe\Control\Controller;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\HiddenField;
use SilverStripe\View\Requirements;
use UncleCheese\BetterButtons\Actions\BetterButtonNestedForm;
use UncleCheese\BetterButtons\Controllers\BetterButtonsCustomActionRequest;

/**
 * Request handler that deals with nested forms
 *
 * @author  Uncle Cheese <unclecheese@leftandmain.com>
 * @package  silverstripe-gridfield-betterbuttons
 */
class BetterButtonsNestedFormRequest extends BetterButtonsCustomActionRequest
{
    /**
     * Define the allowed controller actions
     */
    private static array $allowed_actions = array(
        'Form'
    );

    /**
     * Define URL routes
     */
    private static array $url_handlers = array(
        'Form' => 'Form'
    );

    /**
     * Gets a link to this RequestHandler
     */
    public function Link($action = null)
    {
        return $this->controller->Link('nestedform');
    }

    /**
     * Create the nested form
     *
     * @return  Form
     */
    public function Form()
    {
        $formAction = $this->getFormActionFromRequest($this->request);
        $fields = $formAction->getFields();
        $fields->push(HiddenField::create('action', '', $formAction->getButtonName()));

        return Form::create(
            $this,
            'Form',
            $fields,
            FieldList::create(
                FormAction::create('nestedFormSave', 'Save')
            )
        );
    }

    /**
     * Render the form to the template
     * @return SSViewer
     */
    public function index(HTTPRequest $r): DBHTMLText
    {
        Requirements::css(BETTER_BUTTONS_DIR.'/css/betterbuttons_nested_form.css');

        return $this->customise(array(
            'Form' => $this->Form()
        ))->renderWith(BetterButtonNestedForm::class);
    }

    /**
     * Handles the saving of the nested form. This is essentially a proxy method
     * for the method that the BetterButtonNestedForm button has been configured
     * to use
     *
     * @param  array $data    The form data
     * @param  Form $form     The nested form object
     * @return HTTPResponse
     */
    public function nestedFormSave($data, $form, HTTPRequest $request)
    {
        $formAction = $this->getFormActionFromRequest($request);
        $actionName = $formAction->getButtonName();

        $this->record->$actionName($data, $form, $request);

        return Controller::curr()->redirectBack();
    }

    /**
     * Get the action from the request, whether it's part of the form data
     * or in the query string
     *
     * @return BetterButtonNestedForm
     * @throws Exception If the action doesn't exist, or isn't a BetterButtonNestedForm
     */
    protected function getFormActionFromRequest(HTTPRequest $r)
    {
        $action = $r->requestVar('action');
        $formAction = $this->record->findActionByName($action);

        if (!$formAction instanceof BetterButtonNestedForm) {
            throw new Exception(sprintf("Action %s doesn't exist or is not a BetterButtonNestedForm", $action));
        }

        return $formAction;
    }
}
