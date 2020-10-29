# Network Path Finder

## Initial Thoughts on Solving this problem

* Use PHP args, readline for getting user input
* Use CSV Parser to parse the file 
* Use Graph to denote the network
* Use BFS to navigate the graph and find feasibility
* Later found that finding minimum path is better to accommodate all test cases, so refactored it

## Pre-Requisites

* PHP latest stable(7.4 recommended)

## How to run the file ?

Please run the file by 

```
    php npf.php testfile.csv
```

## How to run tests ?

* Please install phpunit using composer 
```
    composer install
```
* The above should install phpunit in vendor, then run for unix systems

```
    ./vendor/bin/phpunit 
```

* Or for windows run
```
    .\vendor\bin\phpunit
```