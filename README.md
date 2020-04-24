# Prerequisites

- PHP 7.3 for maximum stability
- PHP XML extension

You need to install SimpleXML extension to your project:<br/>
Just paste this line to your composer.json in document root:
```$xslt
"require": {
        "ext-simplexml": "*"
},
```
Then run the following command in console:
`composer update`

# Installation

1.) Run the following command in console:<br />
`composer require komjit/laragent`

2.) Register the service provider in the app.php config file

`KomjIT\LarAgent\LarAgentServiceProvider::class,`

3.) Create the required folders in public folder:

- logs
- pdf
- xmls

# Usage

Coming soon...
