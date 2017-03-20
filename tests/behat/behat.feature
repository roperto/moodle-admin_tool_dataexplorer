@javascript @tool @tool_dataexplorer
Feature: Behat works
  In order to know behat is running
  As behat
  I need to run one scenario

  Scenario: I can see the main page
    Given there is a tool dataexplorere context
    Then I should see "Acceptance test site"
