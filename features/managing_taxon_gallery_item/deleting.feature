@madcoders_taxon_gallery @managing_taxon_gallery_item @deleting_taxon_gallery_item
Feature: Deleting a taxon gallery's item
    In order to remove a taxon gallery's item that is not longer in use
    As an Administrator
    I want to delete this taxon gallery's item

    Background:
        Given the store operates on a single channel in "United States"
        And I am logged in as an administrator

    @ui
    Scenario: Delete a taxon gallery's item
        Given there are taxon gallery's item witch "code_360"
        And I am on taxon gallery item index page
        When I delete the taxon gallery item with code "code_360"
        Then I should be notified that it has been successfully deleted
        And the taxon gallery item with code "code_360" should no longer exist in the registry
