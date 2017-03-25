@javascript @tool @tool_dataexplorer
Feature: Data Explorer Restricted Access
  In order to prevent exposing sensitive data
  As any non-administrator
  I should not be access the Data Explorer

  This scenario is not designed for a use case as it tries to be exaustively check the security.

  Scenario Outline: I can browse to the database explorer
    Given the following "users" exist:
      | username | firstname | lastname | email           |
      | student  | Student   | User     | teacher@asd.com |
    When I log in as "<user type>"
    Then I <see dataexplorer> have access any PHP page inside dataexplorer

    Examples:
      | user type | see dataexplorer |
      | admin     | should           |
      | student   | should not       |
