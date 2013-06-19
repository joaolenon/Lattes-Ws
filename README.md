Lattes Crawler
================

A Crawler for retrieving data from [Lattes](lattes.cnpq.br) website.

API
---

The routes will be divided by:

- ``GET /courses/{slug-course}`` - Retrieves a list of courses registered;
- ``GET /courses/{slug-course}/teachers`` - Retrieves all teacher data a course;
- ``GET /courses/{slug-course}/teachers/{slug-teacher}`` - Retrieves techear selected for course;

On both ``GET`` routes, you can use some query strings:

- ``?orderby=name&ordertype=asc``
- ``?orderby=name&ordertype=desc``
