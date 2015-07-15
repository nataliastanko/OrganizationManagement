Content management app
==========

Example Symfony application

What's inside?
-------------------------------

Bundles:

  * EnrollmentBundle
  * MeetingBundle
  * LogEntryBundle

Integration with:

  * FOSUserBundle

Installation and running
----------------------------------

### Requirements

Make sure you have installed the requirements for running symfony [requirements][1].

PHP >= 5.4

Install [composer][2] to manage dependencies.
To install dependencies run command in project root dir:

    composer install


### Run app

Run the following commands in project root dir:

Create database:

    ./app/console doctrine:database:create

Create/update tables:

    ./app/console doctrine:schema:update --force

Generate assets:

    ./app/console assets:install
    ./app/console assetic:dump

Run server:

    php app/console server:run

Check [http://localhost:8000][3].

In memory authentication:

    user: admin
    password: password

Check [http://localhost:8000][3].

License
---------------

All libraries and bundles included in the Symfony Standard Edition are
released under the MIT license.

The MIT License

Copyright © 2015, Natalia Stanko [nataliastanko.com][5]

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the “Software”), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.


[1]:  http://symfony.com/doc/current/reference/requirements.html
[2]:  http://getcomposer.org/
[3]:  http://localhost:8000/
[4]:  https://phpunit.de/manual/current/en/installation.html
[5]:  http://nataliastanko.com/
