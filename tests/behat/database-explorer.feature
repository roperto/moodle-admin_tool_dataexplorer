@javascript @tool @tool_dataexplorer
Feature: Database Explorer
  In order to explore Moodle's Database
  As a site administrator
  I need to view and browse through the data

  Background: Only admins can use the database explorer
    Given I log in as "admin"

  Scenario: I can browse to the database explorer
    Given I am on site homepage
    When I navigate to "Database Explorer" node in "Site administration > Development > Data Explorer"
    Then I should see "Data Explorer"
    Then I should see "Database Explorer"

  Scenario: I can list the tables of the database
    When I am on the "database-explorer" page in Data Explorer
    Then I should see "users"
    And I should see "One record for each person"
