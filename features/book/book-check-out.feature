Feature:
  In order to borrow a book and take it outside the library
  As a patron of the library
  I need to be able to check out it

  Rule:
  - Patron has variable loan period days and limits related to his type
  - Patron has no debt and unpaid fees
  - Patron does not exceed the limits of borrowed books (overdue and not overdue)
  - The book is not held by another patron at the moment
  - The book is not borrowed by another patron at the moment
  - The book is not for in-library use only
  - The book is lend for period followed by a book privileges policy for graduate students

    Scenario Outline: Checking out a book that is available by graduate student
      Given There is available book
      When Me as a <patron_type> check out this book
      Then This book is borrowed by me
      And I got <days> to return this book

      Examples:
        | patron_type           | days |
        | undergraduate_student | 45   |
        | graduate_student      | 120  |
        | faculty               | 120  |

    Scenario: Checking out a book when patron has unpaid fee
      Given There is available book
      And My balance is -$10
      When Me as a graduate_student check out this book
      Then I see error says "Please pay your fees before you borrow another book"
