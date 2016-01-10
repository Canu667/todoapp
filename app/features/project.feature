Feature: Project Functionality
    in order to segregate tasks
    as a user
    i need to create, modify and delete projects

@javascript
Scenario: Create new project
  Given I am on the homepage
  And I there is no project "My Test Project"
  And I click on "a#add-project"
  Then should see an "#myModalLabel" element
  When fill in "Project name" with "My Test Project"
  And I press "Save"
  Then I should see "My Test Project" in the "ul.nav-list" element

@javascript
Scenario: Modify project
  Given I am on the homepage
  And I there is a project "My Test Project"
  When I double click on the "My Test Project" project
  Then should see an "#myModalLabel" element
  When fill in "Project name" with "My Test Project1"
  And I press "Save"
  Then I should see "My Test Project1" in the "ul.nav-list" element

@javascript
Scenario: Remove project
  Given I am on the homepage
  And I there is a project "My Test Project1"
  When I click on the "My Test Project1" project
  And I click on "a#remove-project" 
  Then I should not see "My Test Project1" in the "ul.nav-list" element