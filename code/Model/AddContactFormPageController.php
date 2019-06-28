<?php

namespace textagroup\dia;

use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextField;

class AddContactFormPage extends ContentController
{
    private static $allowed_actions = [
        'AddContactForm'
    ];

    public function AddContactForm()
    {
        $fields = new FieldList(
            TextField::create('Name', 'Name'),
            TextField::create('Address', 'Address'), //TODO consider consulting address API
            EmailField::create('Email', 'Email'),
            TextField::create('Phone', 'Phone')  // use a text field for leading 0 and +64 etc
        );

        $actions = new FieldList(
            FormAction::create('submitContact')
                ->setTitle('Submit')
        );

        $required = new RequiredFields(['Name', 'Email']);

        $form - new Form($this, 'AddContactForm', $fields, $actions, $required);
    }

    public function submitContact($data, Form $form)
    {
        $form->sessionMessage('Your details have been entered', 'success');

        return $this->redirectBack();
    }
}
