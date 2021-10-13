@madcoders_taxon_gallery @managing_taxon_gallery_item @editing_taxon_gallery_item
Feature: Editing a taxon gallery's item
    In order to ensure that customers have always up to date content
    As an Administrator
    I want to be able to edit taxon gallery's item data

    Background:
        Given the store operates on a single channel in "United States"
        And the store classifies its products as "Clothes" and "Guns"
        And I am logged in as an administrator

    @ui @javascript
    Scenario: Change taxon gallery's item menu taxon
        Given there are taxon gallery's item witch "code_360" and menu taxon "Clothes"
        And I am on taxon gallery's item edit page for code "code_360"
        When I change its menu taxon to "Guns"
        And I click save changes button
        Then I should be notified that it has been successfully edited
        And the taxon gallery item with menu taxon "Guns" should appear in the registry

    @ui @javascript
    Scenario: Change taxon gallery's item to used custom image
        Given there are taxon gallery's item witch "code_360" and menu taxon "Guns"
        And I am on taxon gallery's item edit page for code "code_360"
        When I select "upload own image right now" for "imageSource"
        And I attach the "madcoders.png" image
        And I click save changes button
        Then I should be notified that it has been successfully edited
