@madcoders_taxon_gallery @managing_taxon_gallery_item @managing_taxon_gallery_item_adding
Feature: Adding new item for taxon gallery
    In order to enable customer to see taxon gallery to home page
    As an Administrator
    I want to add new item for taxon gallery

    Background:
        Given the store operates on a single channel in "United States"
        And the store classifies its products as "Clothes" and "Guns"
        And I am logged in as an administrator

    @ui
    Scenario: I can access taxon gallery item create page
        Given I am on taxon gallery item index page
        When I click create button
        Then I should be redirected to taxon gallery item create page

    @ui @javascript
    Scenario: Adding a new item for taxon gallery with image from taxon
        Given I want to create a new item for taxon gallery
        When I fill create form with following data:
            | field               | type              | value                               |
            | code                | field             | code-taxon                          |
        And I switch on enable toggle
        And I specify menu taxon as "Clothes"
        And I select "take existing image from taxon" for "imageSource"
        And I click submit button
        Then I should be notified that it has been successfully created
        And the taxon gallery item with code "code-taxon" should appear in the registry

    @ui @javascript
    Scenario: Adding a new item for taxon gallery with custom image
        Given I want to create a new item for taxon gallery
        When I fill create form with following data:
            | field               | type              | value                               |
            | code                | field             | code-custom                         |
        And I switch on enable toggle
        And I specify menu taxon as "Guns"
        And I select "upload own image right now" for "imageSource"
        And I attach the "madcoders.png" image
        And I click submit button
        Then I should be notified that it has been successfully created
