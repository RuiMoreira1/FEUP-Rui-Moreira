# **EBD: Database Specification Component**

An Online Shop that becomes your ‘street corner’ bookshop only a click away!

# **A4 Conceptual Data Model**

The Conceptual Domain Model identifies all the groups of entities of the domain and the relationships between them in UML class diagram.

The class diagram below represents all the important entities for **'The Last Chapter'** website, the relationships between them with multiplicity associated and also all the relevant attributes with their respective SQL Types.

## A4.1. Class Diagram

![UML Diagram](Pictures/UML_Diagram.png)

*Figure 1: UML Class Diagram*

## A4.2. Additional Business Rules

* **Account Deletion** - In case an account is deleted (by its owner or by an administrator), all the shared user data is kept but made anonymous so that all the relevant information regarding reviews and purchases is maintained (i.e. for statistics).

* **Administrators** - Administrator accounts cannot buy products, as they are the ones that manage them.

* **Write Review** - Only buyers that have bought a product can write a review for that specific product.

* **Edit and Delete Review** - Only the author of a review can edit and/or delete that specific review.

* **Admin Delete Review** - Admins have permission to delete any review.

* **Stock Available** - A registered user can only purchase a product if it is available in stock.

* **Stock Update** - After every purchase, the stocks of the products affected must be updated (decreasing accordingly).

* **Cancel order** - A buyer can only cancel its order if it hasn't already been shipped. (i.e. on the day of the purchase only, not after, not before).

* **Logout** - The logout should only be possible if the user is currently logged in.

# **A5 Relational Schema, validation and schema refinement**

# **A6 Indexes, triggers, transactions and database population**
