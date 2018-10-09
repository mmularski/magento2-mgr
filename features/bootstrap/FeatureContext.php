<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context
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
     * @Given /^I am in login page$/
     */
    public function iAmInLoginPage()
    {
        $this->getSession()->reset();
        $this->visitPath('customer/account/login/');
    }

    /**
     * @Given /^I am in reorder products page$/
     */
    public function iAmInReorderProductsPage()
    {
        $this->visitPath('sales/products/reorder/');
    }

    /**
     * @Given /^I click login$/
     */
    public function iClickLogin()
    {
        $this->getSession()->getPage()->find('css', '#send2')->click();
    }

    /**
     * @When /^I fill email with "([^"]*)"$/
     */
    public function iFillEmailWith($arg1)
    {
        $this->getSession()->getPage()->fillField('email', $arg1);
    }

    /**
     * @Given /^I fill password with "([^"]*)"$/
     */
    public function iFillPasswordWith($arg1)
    {
        $this->getSession()->getPage()->fillField('pass', $arg1);
    }

    /**
     * @Then /^I should see text "([^"]*)"$/
     */
    public function iShouldSeeText($arg1)
    {
        $this->getSession()->getPage()->find(
            'xpath',
            "//div[@class='panel header']//li[@class='greet welcome']//span[1][contains(text(),'{$arg1}')]"
        );
    }

    /**
     * @Then /^I do not see empty list message$/
     */
    public function iDoNotSeeEmptyListMessage()
    {
        $this->assertSession()->elementNotExists('xpath', "//div[@class='message info empty']");
    }
}
