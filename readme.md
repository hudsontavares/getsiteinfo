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
- \App\Traits -> Common functionalities that can be shared among different implementors
