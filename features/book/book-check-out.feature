Feature:
  In order to borrow a book and take it outside the library
  As a patron of the library
  I need to be able to check out it

    Rule:
    - Patron has variable loan period days and limits related to his type
    - Patron does not exceed the limits of borrowed books (overdue and not overdue)
    - Patron has no debt and unpaid fees
    - The book is not held by another patron at the moment
    - The book is not borrowed by another patron at the moment
    - The book is not for in-library use only
    - The book is lend for period followed by a book privileges policy for graduate students

    Scenario: Checking out a book that is available by graduate student
      Given There is available book
      When Me as a Graduate student check out this book
      Then This book is borrowed by me
      And I got 120 days to return this book

    Scenario: Checking out a book that is available by undergraduate student
      Given There is available book
      When Me as a undergraduate student check out this book
      Then This book is borrowed by me
      And I got 45 days to return this book

    Scenario: Checking out a book that is available by faculty
      Given There is available book
      When Me as a faculty check out this book
      Then This book is borrowed by me
      And I got 120 days to return this book
