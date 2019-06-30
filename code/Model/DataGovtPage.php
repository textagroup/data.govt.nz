<?php

namespace textagroup\dia;

use Page;
use SilverStripe\Forms\TextField;
use Psr\SimpleCache\CacheInterface;
use SilverStripe\Core\Injector\Injector;

class DataGovtPage extends Page
{
    private static $table_name = 'DiaGovtPage';

    private static $db = [
        'URL' => 'Text',
        'Resource' => 'Text'
    ];

    private static $has_one = [];

    private static $defaults = [
        'URL' => 'https://catalogue.data.govt.nz/api/action/resource_show?id=',
        'Resource' => '1f7d28c3-012c-4646-958f-6eea488f9a8d'
    ];

    private $apiRequest;


    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $urlField = TextField::create('URL', 'URL')
            ->setDescription('API endpoint');
        $resourceField = TextField::create('Resource', 'Resource')
            ->setDescription('ID of resource to fetch from Endpoint');
        $fields->insertBefore('Content', $urlField);
        $fields->insertAfter('URL', $resourceField);

        return $fields;
    }

    public function getData() {
        $json = file_get_contents($this->URL.$this->Resource);
        $this->apiRequest = json_decode($json);
    }

    private function callAPI() {
        if (!$this->apiRequest) {
            $this->getData();
        }
    }

    public function getFormat() {
        $this->callAPI();
        return $this->apiRequest->result->format;
    }

    public function getActive() {
        $this->callAPI();
        return $this->apiRequest->result->active;
    }

    public function getDocUrl() {
        $this->callAPI();
        return $this->apiRequest->result->url;
    }
}
