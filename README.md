# Network Path Finder

 A simple PHP application to find the feasibility of network path in a given network 

## Initial Thoughts on Solving this problem

* Use PHP args, readline for getting user input
* Use CSV Parser to parse the file 
* Use Graph to denote the network
* Use BFS to navigate the graph and find feasibility
* Later found that finding minimum path is better to accommodate all test cases, so refactored it

## Assumptions

* Graph is bi-directional but need to be explicitly menionted in csv file. 
* For example, the test case `Input: E A 400 Output: E => D => B => A => 120`, it is assumed that E => D will be provided in testfile.csv

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

## License

Copyrights and All rights reserved to the company this test is taken for.