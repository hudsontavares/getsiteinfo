GetSiteInfo

A package to inspect and retrieve information about an URI. Useful for any kind of application that needs
to get and parse metadata from an specific source for integration with other software artifacts. Aside
it's main purpose, the project itself is fully built following the SOLID patterns and have its
funcionalities dependency-injected to make easier to extend behaviors to other desirable ones.

Package structure

- \App -> contains the main class, UriParser
- \App\AttachableParsers -> Implementors of the \App\Interfaces\AttachableParser interface
- \App\DataParsers -> Implementors of the \App\Interfaces\DataParser interface
- \App\Interfaces -> The two interfaces that can be injected on the UriParser
- \App\Traits -> Common functionalities that can be shared among different classes

Installing the package

This library has been written and tested on a PHP 5.6 environment (5.6.8 to be more specific). You can check it
against other versions, older or newer, as far as it implements the namespaces and traits (PHP >= 5.4.0).

Also, ensure the machine you run has all PHP options relative to the protocol you want to receive data enabled.
To keep the compatibility at the best levels, it uses file_get_contents on the HttpGetDataParser instead of
cURL.

1. Ensure you have composer installed on your machine (https://getcomposer.org/)
2. Ensure you have the phpunit PHAR (https://phpunit.de/); all the tests were written against the version 4.6.6
3. Could be real good if you have php, composer and phpunit.phar on you PATH. If you don't, you need to add the complete path to all commands below.
4. At command line, run the following commands:
```
cd <Directory name where you cloned the repository of this library>
composer install
php phpunit.phar
```
If you don't get any errors, when the tests run, it means the library is running properly.

Extending the package

The library ships a basic HTTP GET request class (\App\DataParsers\HttpGetDataParser) and two attachable parsers:
\App\AttachableParsers\HttpHeadersAttachableParser and \App\AttachableParsers\MetatagsAttachableParser.

You can extend them or write new ones (no final usage here). As far as they implements the same interfaces required
by the \App\UriParser class, you can simply inject the new objects on the parser.

Also, the project includes the file idea/Class Diagram.jpg, which is pretty straightforward regarding architecture.