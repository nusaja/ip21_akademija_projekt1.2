As a < user >, 
I want to interact with a < database of cat and dog breed names >,
so that I can < list all of them or search through them >.

Feature: List all breeds

  Scenario: I want a list of all cat breeds
    Given that I correctly provide the prompt
    When I type in "php console.php list cat"
    Then I will get a list of all cat breeds

  Scenario: I want a list of all dog breeds
    Given that I correctly provide the prompt
    When I type in "php console.php list dog"
    Then I will get a list of all dog breeds

    #######################################

  Scenario: I want a list of all cat/dog breeds
    Given that I exclude or incorrectly type in the action "list"
    When I enter the prompt
    Then I will get an error "Action invalid."

  Scenario: I want a list of all cat/dog breeds
    Given that I exclude or incorrectly type in the type "cat"/"dog"
    When I enter the prompt
    Then I will get an error "Type invalid."


Feature: Search through breeds

  Scenario: I want a list of all breed names that relate to my search query
    Given that I type in a valid query that matches any of the breeds in the database
    When I type in "php console.php search cat < search query >" 
    Then I will get a list of breeds that match my search query 

  Scenario: I want a list of cat breed names that relate to my search query
    Given that I type in a valid query that matches any of the breeds in the database
    When I type in "php console.php search dog < search query >" 
    Then I will get a list of breeds that match my search query 

  Scenario: I want a list of dog breed names that relate to my search query
    Given that I type in a valid query that matches any of the breeds in the database
    When I type in "php console.php search both < search query >" 
    Then I will get a list of breeds that match my search query 
    Feature: Search through breeds

    #################################################################################

  Scenario: I want a list of all/cat/dog breed names that relate to my search query
    Given that I exclude or incorrectly type in the action "search"
    When I type in the prompt
    Then I will get an error "Action invalid."

  Scenario: I want a list of all cat breed names that relate to my search query
    Given that I exclude or incorrectly type in the type "cat"/"dog"/"both"
    When I type in the prompt 
    Then I will get an error "Type invalid."

  Scenario: I want a list of all cat breed names that relate to my search query
    Given that I my search query is valid but does not match any breed name 
    When I type in the prompt 
    Then I will get an error "No results." 

    ###########################################################################

  Scenario: I want a list of all breed names that relate to my search query
    Given that my search query is longer than 100 characters
    When I type in the prompt 
    Then I will get a an error "Invalid search!"

  Scenario: I want a list of all breed names that relate to my search query
    Given that my search query is shorter than 1 character
    When I type in the prompt 
    Then I will get an error "Invalid search!" 
    
  Scenario: I want a list of all breed names that relate to my search query
    Given that my search query contains non alphabetical characters
    When I type in the prompt 
    Then I will get a an error "Invalid search!"

    


