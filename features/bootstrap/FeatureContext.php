<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Mink\Exception\ExpectationException;
use Behat\Mink\Exception\ResponseTextException;
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

    /**
     * @Given /^I am logged in with "([^"]*)" and "([^"]*)"$/
     */
    public function iAmLoggedInWithAnd($arg1, $arg2)
    {
        $this->getSession()->reset();
        $this->visitPath('customer/account/login/');
        $this->getSession()->getPage()->fillField('email', $arg1);
        $this->getSession()->getPage()->fillField('pass', $arg2);
        $this->getSession()->getPage()->find('css', '#send2')->click();
    }

    /**
     * @When /^I can add product to cart from reorder products page$/
     */
    public function iCanAddProductToCartFromReorderProductsPage()
    {
        $this->visitPath('sales/products/reorder/');
        $this->assertSession()->elementNotExists('xpath', "//div[@class='message info empty']");
        $grabProductName =
            $this->getSession()->getPage()->find(
                'xpath',
                "//ol[@class='products list items product-items']//li[1]//div[1]//div[1]//strong[1]"
            )->getText();
        $this->getSession()->getPage()->find(
            'xpath',
            "//ol[@class='products list items product-items']//li[1]//div[1]//div[1]//strong[1]"
        )->mouseOver();
        $this->getSession()->getPage()->find(
            'xpath',
            "//ol[@class='products list items product-items']//li[1]//div[1]//div[1]//div[3]//div[1]//div[1]//form[1]//button[1]"
        )->click();
        $this->visitPath('checkout/cart/');
        $this->assertSession()->elementTextContains(
            'xpath',
            "//div[@class='product-item-details']//strong[@class='product-item-name'][contains(.,'$grabProductName')]",
            $grabProductName
        );
    }

    /**
     * @Given /^Process checkout$/
     */
    public function processCheckout()
    {
        $this->visitPath('/checkout');
        $this->waitForPageLoad();
        $this->waitForElement('css', "button.button.action.continue.primary", 60);
        $this->getSession()->getPage()->find(
            'css',
            "button.button.action.continue.primary"
        )->click();
        $this->waitForElement('css', "button.action.primary.checkout", 60);
        $this->waitForPageLoad();
        $this->getSession()->getPage()->find(
            'css',
            "#checkmo"
        )->click();
        $this->getSession()->getPage()->find(
            'css',
            "button.action.primary.checkout"
        )->click();
        $this->waitForElementDisappear('xpath', "//img[@alt='Loading...']", 60);
        $this->waitForPageLoad();
    }

    public function waitForElementDisappear($selector, $locator, $timeout)
    {
        $startTime = time();
        do {
            $node = $this->getSession()->getPage()->findAll($selector, $locator);
            if (count($node) == 0) {
                return true;
            }
        } while (time() - $startTime < $timeout);

        throw new ResponseTextException(
            sprintf('Cannot find the element %s after %s seconds', $locator, $timeout),
            $this->getSession()
        );
    }

    public function waitForElement($selector, $locator, $timeout)
    {
        $startTime = time();
        do {
            $node = $this->getSession()->getPage()->findAll($selector, $locator);
                if (count($node) > 0) {
                    return true;
                }
        } while (time() - $startTime < $timeout);

        throw new ResponseTextException(
            sprintf('Cannot find the element %s after %s seconds', $locator, $timeout),
            $this->getSession()
        );
    }

    public function waitForPageLoad($timeout = 30)
    {
        $this->getSession()->wait($timeout, 'document.readyState == "complete"');

        try {
            $this->getSession()->wait($timeout, '!!window.jQuery && window.jQuery.active == 0;');
        } catch (\Exception $exception) {
            $this->getSession()->wait($timeout);
        }

        $this->getSession()->wait(1);
    }

    /**
     * @Then /^I see success page$/
     */
    public function iSeeSuccessPage()
    {
        $this->assertPageAddress('checkout/onepage/success/');
    }
}
