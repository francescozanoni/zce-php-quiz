# zce-php-quiz
Zend PHP certification training quiz

----

Example of quiz item within XML file:
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