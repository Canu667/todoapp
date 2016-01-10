Feature: The site is on
    in order to check if the site is on
    as a user
    i need to be able to access it

Scenario: Access the site
  When I am on the homepage
  Then the response status code should be 200
  And I should see "PROJECTS" in the "#projects > li.nav-header" element
