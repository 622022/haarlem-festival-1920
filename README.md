# TEAM SPEC OPS HAARLEM FESTIVAL DOCUMENTATION

## Todo

* Ticket ordering system
* Event table (M)
* Event display system (Z)
* Page info table (M)
* Page info display system
* Add customer table (M)
* Add ticket table (M)
* Ticket service
* Page service
* Password reset (T)
* Make event page (N)

## Setup

1. Make sure the `config/credentials.php` is correct.

## Random fricking ideas

* Unique ID/Barcode linked to ticket
* Need customer with first name and email
* Only one event page
* Make simple frontend pages first then bother with functionality
* Make section folder for repeatable interface sections (php include 'em)

## Functions

### dataLayer

#### dataLayer.getInstance()

Returns the existing instance of the dataLayer. If this does not exist already it will create one and return that instead.

**Returns:** `dataLayer` – The existing or newly created instance of this dataLayer.

#### dataLayer.doesUserExist(string *email*)

Returns a boolean indicating whether or not this user already exists in the database.

**Parameters:**

1. **string** email – The string in email format that this function will be used to check if it is present in the database.

**Returns:** `boolean` – True if this email is already present in the database.

#### dataLayer.registerUser(User *user*)

Registers a user in the database then returns whether this operation was succesful or not.

**Parameters:**

1. **User** user – A user object that represents the newly created user that's trying to register.

**Returns:** `boolean` – True if this user was succesfully registered.

#### dataLayer.getHashedPass(string *email*)

Returns the hashed password of the user with this email address.

**Parameters:**

1. **string** email – The string in email format that this function will use to retrieve the hashed password.

    **Note:** This is not a plaintext password and has to be checked with a function that will consider it a hashed password.

**Returns:** `string` – The hashed password in string format.
