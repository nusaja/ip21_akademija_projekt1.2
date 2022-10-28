As a < user >, 
I want to interact with a < database of cat and dog breed names >,
so that I can < list all of them or search through them >.

Feature: List all breeds

  Scenario: I want a list of all cat breeds
    Given that I don't make a typing mistake
    When I type in "php console.php list cat"
    Then I will get a list of all cat breeds

  Scenario: I want a list of all dog breeds
    Given that I don't make a typing mistake
    When I type in "php console.php list dog"
    Then I will get a list of all dog breeds

Feature: Search through breeds

  Scenario: I want a list of all breed names that relate to my search query
    Given that I type in a query that matches any of the breeds in the database
    When I type in "php console.php search both/cat/dog < search query >" 
    Then I will get a list of breeds that match my search query 
