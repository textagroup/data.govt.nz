<?php

namespace textagroup\dia;

use PageController;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\HiddenField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\EmailField;

class AddContactFormPageController extends PageController
{
    private static $allowed_actions = [
        'AddContactForm'
    ];

    public function AddContactForm()
    {
        $fields = new FieldList(
            $name = TextField::create('Name', 'Name'),
            $address = TextField::create('Address', 'Address'), //TODO consider consulting address API
            $email = EmailField::create('Email', 'Email'),
            $phone = TextField::create('Phone', 'Phone')  // use a text field for leading 0 and +64 etc
        );

        // check if we are editing a contact and prefill the form if we are
        $id = (int)$this->getRequest()->getVar('ID');
        if ($id > 0) {
            $idField = HiddenField::create('ID', 'ID', $id);
            $fields->push($idField);
            $contact = Contact::get()->byID($id);
            if ($contact && $contact->exists()) {
                $name->setValue($contact->Name);
                $address->setValue($contact->Address);
                $email->setValue($contact->Email);
                $phone->setValue($contact->Phone);
            }
        }

        $actions = new FieldList(
            FormAction::create('submitContact')
                ->setTitle('Submit')
        );

        $required = new RequiredFields(['Name', 'Email']);

        $form = new Form($this, 'AddContactForm', $fields, $actions, $required);
        return $form;
    }

    public function submitContact($data, Form $form)
    {
        // Are we updating an existing record or adding a whole new one
        if (isset($data['ID']) && is_numeric($data['ID'])) {
            $id = (int)$data['ID'];
            $contact = Contact::get()->byID($id);
            $message = 'Your details have been updated';
        } else {
            $contact = new Contact();
            $message = 'Your details have been entered';
        }
        foreach (['Name', 'Address', 'Email', 'Phone'] as $key) {
            if (isset($data[$key])) {
                $contact->$key = $data[$key];
            }
        }
        $contact->write();
        $form->sessionMessage($message, 'success');

        return $this->redirectBack();
    }
}
