<?php


class ReorderProductsCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function _after(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->amOnPage("customer/account/login/");
        $I->waitForPageLoad();
        $I->fillField("#email", "mmularczyk9@gmail.com");
        $I->fillField("#pass", "Admin123");
        $I->click("#send2");
        $I->waitForPageLoad();
        $I->amOnPage("sales/products/reorder/");
        $I->dontSee("//div[@class='message info empty']");
        $grabProductName = $I->grabTextFrom("//ol[@class='products list items product-items']//li[1]//div[1]//div[1]//strong[1]");
        $I->moveMouseOver("//ol[@class='products list items product-items']//li[1]//div[1]//div[1]//strong[1]");
        $I->click("//ol[@class='products list items product-items']//li[1]//div[1]//div[1]//div[3]//div[1]//div[1]//form[1]//button[1]");
        $I->amOnPage("checkout/cart/");
        $I->see($grabProductName, "//div[@class='product-item-details']//strong[@class='product-item-name'][contains(.,'$grabProductName')]");
        $I->amOnPage("/checkout");
        $I->waitForPageLoad();
        $I->waitForElement("button.button.action.continue.primary", 60);
        $I->click(".row:nth-of-type(1) .col-method .radio");
        $I->wait(30);
        $I->waitForElement("button.button.action.continue.primary", 60);
        $I->click("button.button.action.continue.primary");
        $I->waitForElement("button.action.primary.checkout", 60);
        $I->waitForPageLoad();
        $I->click("#checkmo");
        $I->click("button.action.primary.checkout");
        $I->waitForPageLoad();
        $I->seeCurrentUrlEquals("/checkout/onepage/success/");
    }
}
