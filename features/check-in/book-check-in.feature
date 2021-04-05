Feature:
  In order to return a book
  As a patron of the library
  I need to check in

  Scenario: Check in book
    Given There is a book borrowed by me
    When I check-in this book
    Then This book is returned by me
    And It can be borrowed again

  Scenario: Check in book over due
    Given There is a book borrowed by me
    And Due date of this book is at 2020-01-01
    And The today is date 2020-01-03 12:10
    When I check-in this book
    Then This book is returned by me
    And This book is 2 days overdue

