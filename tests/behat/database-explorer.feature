@javascript @tool @tool_dataexplorer
Feature: Database Explorer
  In order to explore Moodle's Database
  As a site administrator
  I need to view and browse through the data

  Scenario: I can browse to the database explorer
    Given I log in as "admin"
    And I am on site homepage
    When I navigate to "Database Explorer" node in "Site administration > Development > Data Explorer"
    Then I should see "Data Explorer - Database"
