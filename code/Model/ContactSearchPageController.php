<?php

namespace textagroup\dia;

use PageController;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\ArrayList;
use SilverStripe\View\ArrayData;

class ContactSearchPageController extends PageController
{
    private $searchResults;

    private static $allowed_actions = [
        'ContactSearchForm'
    ];

    public function ContactSearchForm()
    {
        $session = $this->getRequest()->getSession();
        $this->searchResults = $session->get('SearchResults');
        $session->set('SearchResults', null);
        $fields = new FieldList(
            TextField::create('Search', 'Search for Contact')
        );

        $actions = new FieldList(
            FormAction::create('submitContactSearch')
                ->setTitle('Search')
        );

        $required = new RequiredFields(['Search']);

        $form = new Form($this, 'ContactSearchForm', $fields, $actions, $required);
        return $form;
    }

    public function submitContactSearch($data, Form $form)
    {
        unset($this->searchResults);
        $ids = ArrayList::create();
        if (isset($data) && isset($data['Search'])) {
            $search = $data['Search'];
            $results = Contact::get()
                ->filterAny([
                    'Name:PartialMatch' => $search,
                    'Address:PartialMatch' => $search,
                    'Email:PartialMatch' => $search,
                    'Phone:PartialMatch' => $search
               ]);
            foreach ($results as $result) {
                $ids->push(ArrayData::create(['Name' => $result->Name, 'ID' => $result->ID]));
            }
        }
        
        $session = $this->getRequest()->getSession();
        $session->set('SearchResults', $ids);

        return $this->redirectBack();
    }

    public function contactList() {
        return $this->searchResults;
    }

    public function getContactFormLink() {
        //TODO what happens if no pages exist or there is more then one
        $page = AddContactFormPage::get()->first();
        if ($page && $page->exists()) {
            return $page->Link();
        }
    }
}
