Feature: Check Reorder Products
  Aby moc zamowic ponownie produkty
  Jako Klient
  Chce zalogowac sie do panelu kleinckiego, wejsc w zakladke "Reorder products" aby moc dodac produkty do koszyka

  Scenario: Check list of products
    Given I am logged in with "mmularczyk9@gmail.com" and "Admin123"
    When I can add product to cart from reorder products page
    And Process checkout
    Then I see success page