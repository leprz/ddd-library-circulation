Feature:
  In order to return a book
  As a patron of the library
  I need to check in

  Scenario: Check in book
    Given There is a book borrowed by me
    When I check-in this book
    Then This book is returned by me
    And It can be borrowed again
