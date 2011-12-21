Introduction
============

This is a [CodeIgniter](http://codeigniter.com) project to provide a client portal for the [phpBMS](http://phpbms.org) platform. While phpBMS provides the means to add a username and password to a client record, it does not currently do anything with that information (a client cannot use those credentials to authenticate with phpBMS). When this project is installed alongside phpBMS, clients can:

* View orders
* View quotes
* View invoices
* See balance due on invoices
* View accounts receivable entries and status
* View contact information for account
* Make a payment using PayPal Express Checkout (redirects to PayPal)
* E-mail an administrator

Because the project is built with CodeIgniter, you can fork/modify as needed.

Installation
============

* Obtain project files from [Github repository](https://github.com/stephenyeargin/php-client-portal)
* Stage it in a CodeIgniter compatible hosting environment that can connect to the same database as phpBMS.
* Make the ./application/cache and ./application/logs folders writable by Apache.
* Copy ./application/config/database.php-dist to ./application/config/database.php and update information to connect to the phpBMS database.
* Copy ./application/config/application.php-dist to ./application/config/application.php and update with your information.
* Modify ./application/config/config.php as needed to work properly with your hosting environment/preferences. The defaults should work as well.

Usage
=====

To use the client portal, you first have to have a client record in phpBMS that has a username and password associated with it (see right-hand column when editing a client). Use these credentials to access the client portal, and share them with your clients as you wish.

Why phpBMS?
===========

It was a very promising platform for freelancers wanting to self-host their invoice system. phpBMS has not had a new release since January 2010 and has a number of known issues. All signs point phpBMS being abandonware. That was not the case when this particular project began. It has since been moved to CodeIgniter from a proprietary framework for better interoperability and testing.

What's next?
============

If a suitable replacement is found for phpBMS, components of this project will likely switch to connect with that platform instead. In the spirit of open source software, you are encouraged to fork this repository if you already have a better platform and want to bootstrap your own integration.