@users
Feature: Users
  As an API consumer
  I need to be able to manage the users

  Scenario: Create a new user
    When I send POST request to "/users" with payload from "create-user.json"
    Then response status code should be 201
    And response entity should contain the values:
      | username  | batman |
      | firstname | Bruce  |
      | lastname  | Wayne  |
    And a "user" with the following data should have been created:
      | username  | batman |
      | firstname | Bruce  |
      | lastname  | Wayne  |