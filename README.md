# products
Products API example

Sample Products API
====================
* This is an API for a sample products mocks.
* Mocks are found in "mocks" directory.
* I've used my own custom code to be like a simple framework MVC "No Views :)".
* Index file is working as a middleware that use Routing helper to expect which controller and action will be excuted.
* I used A model Product to hold all product data.
* As Persistance of data is out of scode , so i saved mocks data in array.
* I used PHP unit testing framework to handle simple tests for this API.

Directory guide
---------------
--Controller
|
-------Products controller ( Hold all actions )
|
--Helpers ( Hold all helper methods and services )
|
--Models ( Hold all products data )
|
-------Product Model
|
--Mocks ( Hold API sample data )
|
--Test ( Hold simple tests )