Feature:
  In order to borrow a book and take it outside the library
  As a patron of the library
  I need to be able to check out it

  Rule:
  - Patron has variable loan period days and limits related to his type
  - Patron has no debt and unpaid fees
  - Patron does not exceed the limits of borrowed books (overdue and not overdue)
#  - The book is not held by another patron at the moment
  - The book is not borrowed by another patron at the moment
#    TODO
  - The book is not for in-library use only

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
      Then I see error says "Please pay your fees before you borrow another book."

    Scenario Outline: Checking out a book with maximum borrow limit
      Given There is available book
      And I got not overdue <borrowed_books>
      When Me as a <patron_type> check out this book
      Then This book is borrowed by me

      Examples:
        | patron_type           | borrowed_books |
        | undergraduate_student | 10             |
        | graduate_student      | 125            |
        | faculty               | 500            |

    Scenario Outline: Checking out a book when limit of borrowed books is exceeded
      Given There is available book
      And I got not overdue <borrowed_books>
      When Me as a <patron_type> check out this book
      Then I see error says "Items limit has been reached. Please return some items first."

      Examples:
        | patron_type           | borrowed_books |
        | undergraduate_student | 11             |
        | graduate_student      | 126            |
        | faculty               | 501            |

    Scenario Outline: Checking out a book when limit of overdue books is exceeded
      Given There is available book
      And I got <overdue_books> that are overdue
      When Me as a <patron_type> check out this book
      Then I see error says "Too many overdue items. Please return items and clear your dues first."

      Examples:
        | patron_type           | overdue_books |
        | undergraduate_student | 11            |
        | graduate_student      | 26            |
        | faculty               | 51            |

    Scenario Outline: Checking out a book with maximum overdue items limit
      Given There is available book
      And I got <overdue_books> that are overdue
      When Me as a <patron_type> check out this book
      Then This book is borrowed by me

      Examples:
        | patron_type           | overdue_books |
        | undergraduate_student | 10            |
        | graduate_student      | 25            |
        | faculty               | 50            |

    Scenario: Checking out a book when someone else already borrow it
      Given There is not available book
      When Me as a graduate_student check out this book
      Then I see error says "This book is already borrowed."

