#Advancelearn Otp-auth

<img src="https://banners.beyondco.de/Laravel%20Otp%20Handler.png?theme=light&packageManager=composer+require&packageName=advancelearn%2Fotp-auth&pattern=hexagons&style=style_1&description=otp+generate+for+one+field+from+client+and+after+create+otp+you+can+checked+is+true+token&md=1&showWatermark=0&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg" alt="advancelearn-otp-auth">


[![Latest Stable Version](http://poser.pugx.org/advancelearn/otp-auth/v)](https://packagist.org/packages/advancelearn/otp-auth) [![Total Downloads](http://poser.pugx.org/advancelearn/otp-auth/downloads)](https://packagist.org/packages/advancelearn/otp-auth) [![Latest Unstable Version](http://poser.pugx.org/advancelearn/otp-auth/v/unstable)](https://packagist.org/packages/advancelearn/otp-auth) [![License](http://poser.pugx.org/advancelearn/otp-auth/license)](https://packagist.org/packages/advancelearn/otp-auth) [![PHP Version Require](http://poser.pugx.org/advancelearn/otp-auth/require/php)](https://packagist.org/packages/advancelearn/otp-auth)
<a name="introduction"></a>

## Introduction

Welcome to the first package from AdvanceLearn Academy. In this package, we tried to make it easy to create a validation
code that is easily available to you, and after receiving the code and token, send it to the user via SMS or email to
fill in the form. Validate the user to enter this token and then we will validate the token with the username you send
and return the result to you.

<a name="installation"></a>

## Installation

You can install the package with Composer.

```bash
composer require advancelearn/otp-auth
```

<a name="usage"></a>

## Usage

The `advancelearn/otp-auth`, It is enough to create an object from the main class of the package and in the first step,
call the method related to creating the token and send the value of the username to it.

## new Object of advancelearn/otp-auth:

### and call generateToken method::

```php
$package = new OtpHandlerAdvancelearn();
```

add namespace of package to top your php class

```php
use Advancelearn\OtpAuth\OtpHandlerAdvancelearn;
```

now call method generateToken and passed data for generate new token and set time for caching otp code

```php
$username = request()->input('username');
$token = $package->generateToken(['username' => $username , 'time' => 3]);
```

#### Username can be the user's email or mobile phone

In this section, you have received the code. Now, according to your project scenario, you can send the validation code
to the user, and in the next step, receive the token from the user and send it to the package validation method for
accuracy:

```php
$token = request()->input('token');
 return $package->verify(['token' => $token , 'username' => $username]);

//example output: If the token is correct than the user's username
{
    "success": "Token is verified you can register or logged in user",
    "status": true
}
```

<a name="conclusion"></a>

## Conclusion

With this advanced learning package called advancelearn/otp-auth, you can easily send the user's username and receive
the token, and you will not have the trouble of creating or saving the token in the database, because the token for the
user's username is easily cached according to the time you give. and in the second step, the token validation is applied
to the requested username, and according to that, you can successfully register the user in the system or direct the
user to the resend code page.
