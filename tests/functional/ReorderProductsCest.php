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
        $I->amOnPage('customer/account/login/');
        $I->fillField(['id' => 'email'], 'mmularczyk9@gmail.com');
        $I->fillField(['id' => 'pass'], 'Admin123');
        $I->clickWithLeftButton('#send2');
        $I->amOnPage('sales/products/reorder/');
        $I->dontSeeElement("//div[@class='message info empty']");
    }
}
