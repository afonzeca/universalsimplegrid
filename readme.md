# Synopsis
The aim of the package Universal Simple Grid (Usg) is giving to Laravel 5 developers an easy way for creating, managing and representing DB data tables inside a "Data Grid" by using simple classes and methods with a "fluent" approach inside code.
The package itself doesn't have its own data grid engine, but it uses the concept of "Grid Vendor Driver" (see next paragraphs).

# Code Example
Before describing the advantages and the approach of the Usg project, let's see a piece of code with and without the use of Usg.

In the example, a tipical Laravel controller, I will use the "Nayjest Vendor Driver" and than a link to the "vanilla" Nayjest Grid code for showing the difference (see https://github.com/Nayjest/Grids for Nayjest Grid details)


## Use Usg... Luuuuuuke!
```php

<?php

namespace App\Http\Controllers;

use AFonzeca\UniversalSimpleGrid\UsgFactory;

class Demo extends Controller
{
    // Full demo of Ny Grid Driver

    public function nyGridFull()
    {

        // Define a Query Builder for retriving data
        $dataSource =
            UsgFactory::factory('NyGrid', 'DataSourceHandler')
            ->init(
                (new \App\Contact())
                ->newQuery()
            );

        // Define the upper part of the grid using a WidgetsBar
        // Put a select box for number of records per page
        // Add a filter button
        $contactHeaderWidget =
            UsgFactory::factory('NyGrid', 'WidgetsBar')
            ->addWidgetRecordsPerPage([10, 25, 50])
            ->addWidgetDoButton();

        // Define the lower part of the grid using a WidgetsBar
        // Put a pagination widget
        $contactFooterWidget =
            UsgFactory::factory('NyGrid', 'WidgetsBar')
            ->addPagination();

        // Define a new grid for an ipotetical "contact" table, attach the widget on the top
        // of grid, define icons and fields.
        $contactGridConfig =
            UsgFactory::factory('NyGrid', 'GridSetup')
            ->setIcons(UsgFactory::factory('NyGrid', 'GlyphiconIcons'))
            ->setIdKey('id')
            ->setBasePath('contact')
            ->setBuilder($dataSource)
            ->attachToHead($contactHeaderWidget)
            ->addBsEditIcon()
            ->addGenericBsIconWithBasePath('glyphicon-tags', 'copy', 'contact', true)
            ->addFieldWithFilterAndOrder('name', 'First Name')
            ->addFieldWithFilterAndOrder('surname', 'Surname')
            ->addBsTrashIcon()
            ->attachToFooter($contactFooterWidget);

        // Get the grid string and pass it to view
        $contactGrid =
            UsgFactory::factory('NyGrid', 'Grid')
            ->init($contactGridConfig)
            ->getGrid();

        return view('demo.fullGrid', compact('contactGrid'));
    }
}
?>
```

After passing the grid string to your view, print it with

```php
<?php 

echo $contactGrid; 

?>

```

or with Blade

```
{!! $contactGrid !!}
```



## The old way! Making a grid without Usg
I'm improving the documentation... meanwhile take a look to Nayjest Grid readme (Advanced example paragraph) for an [example](https://github.com/Nayjest/Grids) of grid configuration using an array.

The result is great, but the code is not too much compact (thank you Vitalii Stepanenko for your great work!)

So let's use Usg! ;-)


# Motivation and Concepts
## Motivations
Usg package can be considered a "micro-framework", composed of a set of abstracts API (Interfaces and Abstract classes) and a set of several "Grid Vendor Drivers" which are the real implementations of those API for supporting each grid engine of different vendors.
The goal of the API is to hide, behind its methods, a super-set of the real methods for a specific Data Grid Vendor implementation.
So every "Grid Vendor Driver" will expose only objects and methods common to all the implementations defined by Usg. These methods allows to manipulate, configure and use every grid from different vendors with the same code.

The advantage is that the developer can write only one time the code for the Data Grid, and he/she could replace a Grid made by a specific vendor with another, by changing two or three lines of code (a factory class allows to instantiate a driver by specifying the vendor name).

## Usg is an elegant, fast, smart and simple way to manage a Data Grid for Laravel 5
Usg, as told previously, was born also to simplify and reduce the code for creating grids. Indeed, as showns above, many native Data Grid implementations require that the developer must specify parameters inside long arrays (name, label, attributes... for every field of a Grid).

Although this approach is flexible and the result is great ( thanks you Vitalii Stepanenko ;-) ), sometimes it is difficult to maintain and fix the code.
Indeed it is easy to make mistakes while changing or modify one or more fields inside long list of array elements. It can be a very slow process.

By using Usg with its fluent approach and its own grid vendors driver, it is possible to have a "common and elegant language" for managing a Data Grid, with the advantage that if the developer (or his/her customer) want to change the "engine" for a grid, modify the order of the fields, etc. it will be easy to do.

**Notes**

* At the moment (version 0.1) there is only one Grid Vendor Driver available, which allows to use the Usg API for the Nayjest Data Grid. I'm working on other drivers that I will release when ready.

* The project is in alpha stage, although it is designed with good coding practices in mind, at this stage it could be possible that the specification could be changed according to the some improvements.

* Do not use in production environments

* No support for relations in this version


# Installation
## Install using Composer 

from command line inside your laravel 5 project use:

```
composer require afonzeca/universalsimplegrid:"@dev"
```

for enabling Ny driver support use:  

```
composer require nayjest/grids laravelcollective/html
```

and then follow the steps inside the paragraph "Notes for Nayjest Grid (Ny Vendor Driver)"


## Install from GitHub source zip
* Download the zip

* create /vendor/afonzeca/ in your laravel project and unzip inside 

* Under providers in config/app.php file, paste the following

```
    AFonzeca\UniversalSimpleGrid\UsgInterfaceServiceProvider::class
```
* Inside composer.json in your project root, under PSR-4 add the following

```
"AFonzeca\\UniversalSimpleGrid\\": "vendor/afonzeca/universalsimplegrid-master/src"
```

* From the command line, inside you project root run:

```
composer dump-autoload
```

### The following dependencies must be installed
* php >=5.5.9
* laravel/framework >=5.1
* nayjest/grids 
* laravelcollective/html >=5.1


## Notes for Nayjest Grid (Ny Vendor Driver)

1) If you want to use Nayjest Grid, do not follow the configuration steps inside their github readme.

   Add these on your config/app.php ( otherwise Grids will not work on Laravel 5.* ):

	1.1) To the bottom of "providers" array add the following:
```php
        Nayjest\Grids\ServiceProvider::class,
        Collective\Html\HtmlServiceProvider::class,
```
	1.2) To the bottom of "aliases" array add the following:
```php
        'Input' => Illuminate\Support\Facades\Input::class,
        'Form' => Collective\Html\FormFacade::class,
        'HTML' => Collective\Html\HtmlFacade::class,
        'Grids' => Nayjest\Grids\Grids::class,
```
2) Your view (or your masterview) must contain references to Bootstrap3


# API References
All the code is well documented, please see the code inside [universalsimplegrid/src/vendor/NyGrid](https://github.com/afonzeca/universalsimplegrid/tree/master/src/vendor/NyGrid)
folder for the methods available for Najest Grid Driver.

Every method is described inside php files of [Contracts](https://github.com/afonzeca/universalsimplegrid/tree/master/src/Contracts) folder. See also [Abstracts](https://github.com/afonzeca/universalsimplegrid/tree/master/src/Abstracts) folder.

If you prefer, all the comments in the code are in PhpDocumentator format, so you can run 

```php
phpdoc -d src
```

inside the package root (usually /vendor/afonzeca/universalsimplegrid) for generating hypertext documentation.


I'm working on a manual/tutorial about the API! I will publish it ASAP!

If you want to help me and want to make a "Grid Vendor Driver" for a specific grid you like... please contact me! :-)


# Contributors
At the moment... Me, myself and I (Angelo Fonzeca)!

The project is dedicated to my sweet wife Carla.


# License
The MIT License (MIT)
Copyright (c) 2016 Angelo Fonzeca

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

https://opensource.org/licenses/MIT
