# DIA form example

Basic SilverStripe 4 module with the following basic pages

* Page with a form to accept data and store the data in a model
* Page with a form to search and update the data
* Some way of displaying data form data.govt.nz

# Ideas

* JavaScript validation on the forms
* Exporting model data to a CSV format
* Export contact data to something like a vCard
* Export govt data to a pdf/csv
* Unit tests
* Cache the JSON data pulled from data.govt.nz
* Do more with the data from govt.nz like show more info

# Installation

* change into your SilverStripe installation root folder (contains a vendor folder)
* Create a folder called textagroup under the vendor directory
* Run the following command to clone the module

git clone https://github.com/textagroup/data.govt.nz.git vendor/textagroup/dia

# Pages

The module contains the following page types

* Add Contact Form Page
This page contains a simple form to allow users to enter there contact data (name, Address , Email and Phone)

* Contact Search Page
This page contains a form to search for existing contacts with links to edit existing contacts

* Data Govt Page
This page has 2 extra CMS fields URL and Resource URL is a API endpoint and defaults to the data.govt.nz endpoint.
Resource is the ID of an dataset resource it defaults to "At-Sea Observations of Seabirds 1969 to 1990"
The page pulls all the JSON data from the but currently only uses the format of the data if it is active and
the URL to download the data in CSV format.

# Testing

Have added a simple PHPUnit test which only tests the very basics of the Contact model.
A lot more testing could be added
