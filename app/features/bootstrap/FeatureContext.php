<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Mink\Driver\Selenium2Driver;
use Behat\Behat\Hook\Scope\AfterStepScope;
/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }
    
    /**
    * @Then /^I click on "([^"]*)"$/
    */
    public function iClickOn($arg1)
    {
       $page = $this->getSession()->getPage();

       $findName = $page->find("css", $arg1);
        if (!$findName){
           throw new Exception($arg1." could not be found");
       }
       else {
           $findName->click();
       }
    }
    
  /**
     * @Given I there is no project :arg1
     */
    public function iThereIsNoProject($arg1)
    {
        $all_projects = $this->getSession()->getPage()->findAll('css', '#projects li');

        foreach($all_projects as $project) {
            $class = $project->hasClass('nav-header');
            if(!$class) {
                if($project->getText() == $arg1) {
                    throw new Exception("Project $arg1 already present on the list!!");
                }
            }
        }
    }
 
    /**
     * @Given I there is a project :arg1
     */
    public function iThereIsAProject($arg1)
    {
        $all_projects = $this->getSession()->getPage()->findAll('css', '#projects li');
        $project_exists = FALSE;
        foreach($all_projects as $project) {
            $class = $project->hasClass('nav-header');
            if(!$class) {
                if($project->getText() == $arg1) {
                    $project_exists = TRUE;
                }
            }
        }
        
        if (!$project_exists) {
            throw new Exception("Project $arg1 not present on the list!!");
        }         
    }

    /**
     * @When I click on the :arg1 project
     */
    public function iClickOnTheProject($arg1)
    {
        $all_projects = $this->getSession()->getPage()->findAll('css', '#projects li');
        $clicked = FALSE;
            
        foreach($all_projects as $project) {
            $class = $project->hasClass('nav-header');
            if(!$class) {
                if($project->getText() == $arg1) {
                    $project->find('css', 'a')->click();
                    $clicked = TRUE;
                }
            }
        }
        
        if (!$clicked) {
            throw new Exception("Could not find project $arg1 on the list!!");
        }    
    }
   
    /**
     * @When I double click on the :arg1 project
     */
    public function iDoubleClickOnTheProject($arg1)
    {
        $all_projects = $this->getSession()->getPage()->findAll('css', '#projects li');
        $clicked = FALSE;
            
        foreach($all_projects as $project) {
            $class = $project->hasClass('nav-header');
            if(!$class) {
                if($project->getText() == $arg1) {
                    $project->find('css', 'a')->doubleClick();
                    $clicked = TRUE;
                }
            }
        }
        
        if (!$clicked) {
            throw new Exception("Could not find project $arg1 on the list!!");
        }    
    }
    
}
