# zce-php-quiz
Zend PHP certification training quiz

----

## Quiz item format within XML file

```xml
<?xml version="1.0" encoding="UTF-8"?>
<items>

  [...]

  <item>

    <question>What is the output?</question>
  
    <code>
      <![CDATA[
        <?php
        echo 'Hello World';
      ]]>
    </code>
  
    <answers>
      <answer>A warning</answer>
      <answer>A fatal error</answer>
      <answer correct="correct">Hello World</answer>
    </answers>
  
    <theory>"echo" command outputs text</theory>

    <reference>http://php.net/manual/en/function.echo.php</reference>
  
  </item>

  [...]
  
</items>
```

----

## Demo

1. start a local webserver:
   ```bash
   php -S localhost:8000
   ```

1. browse URL http://localhost:8000/demo

----

## List of Exam Topics

(from http://www.zend.com/en/services/certification/php-certification):

PHP Basics
- Syntax
- Operators
- Variables
- Control Structures
- Language Constructs and Functions
- Namespaces 
- Extensions
- Config
- Performance/bytecode caching

Functions
- Arguments
- Variables
- References
- Returns
- Variable Scope
- Anonymous Functions, closures
- Type Declarations

Data Format & Types
- XML Basics
- SimpleXML
- XML Extension
- Webservices Basics
- SOAP
- JSON 
- DateTime 
- DOMDocument

Web Features
- Sessions
- Forms
- GET and POST data
- Cookies
- HTTP Headers
- HTTP Authentication
- HTTP Status Codes

Object Oriented Programming
- Instantiation
- Modifiers/Inheritance
- Interfaces
- Return Types
- Autoload
- Reflection
- Type Hinting
- Class Constants
- Late Static Binding
- Magic (_*) Methods
- Instance Methods & Properties
- SPL
- Traits 

Security
- Configuration
- Session Security
- Cross-Site Scripting
- Cross-Site Request Forgeries
- SQL Injection
- Remote Code Injection
- Email Injection
- Filter Input
- Escape Output
- Encryption, Hashing algorithms
- File uploads
- PHP Configuration
- Password hashing API 

I/O
- Files
- Reading
- Writing
- File System Functions
- Streams
- Contexts

Strings & Patterns
- Quoting
- Matching
- Extracting
- Searching
- Replacing
- Formatting
- PCRE
- NOWDOC
- Encodings

Databases & SQL
- SQL
- Joins
- Prepared Statements
- Transactions
- PDO

Arrays
- Associative Arrays
- Array Iteration
- Array Functions
- SPL, Objects as arrays 
- Casting

Error Handling
- Handling Exceptions
- Errors
- Throwables
