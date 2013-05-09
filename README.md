schoolnet-crawler
================

A Crawler for retrieving data from [Uniararas](http://uniararas.br) schoolnet system.

API
---

The routes will be divided by:

- ``POST /user/{id}/auth`` - Authentication of the user (the same username/password of the schoolnet system);
- ``GET /user/{id}/points`` - Retrieve the points separated by class;
- ``GET /user/{id}/frequency`` - Retrieve the frequency separated by class;

On both ``GET`` routes, you can use some query strings:

- ``?orderby=class&ordertype=asc``
- ``?orderby=class&ordertype=desc``

You can specify the by the value too. On the ``Points`` route:

- ``?orderby=points&ordertype=asc``
- ``?orderby=points&ordertype=desc``

On ``Frequency`` route:

- ``?orderby=frequency&ordertype=asc``
- ``?orderby=frequency&ordertype=desc``