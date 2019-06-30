<?php

use SilverStripe\Dev\SapphireTest;
use textagroup\dia\Contact;

class ContactModelTest extends SapphireTest
{
    /** 
     * Defines the fixture file to use for this test class
     * @var string
     */
    protected static $fixture_file = 'ContactModelTest.yml';

    /**
     * Test Model creation is valid
     *
     */
    public function testContactModel()
    {
        $contacts = Contact::get();
        $this->assertEquals($contacts->count(), 1);
        $this->assertEquals($contacts->first()->Name, 'Users Name');
        $this->assertEquals($contacts->first()->Address, 'Users Address');
        $this->assertEquals($contacts->first()->Email, 'user@email.com');
        $this->assertEquals($contacts->first()->Phone, '123454');
    }
}
