# TEST EWAVE

All the three tests are done and in this repository:

# Folders

php-redis: This is the folder that contains the solution using Redis cache together with PHP

javascript:This is the folder that contains the solution of Javascript challenge

css: This is the folder that contains the solution of css challenge

# How to use it

Clone the git project using the command on an empty folder of your web server folder:

```
git clone https://github.com/MFDonadeli/ewave_test.git
```

Follow the instructions for each solutions as indicated below

# PHP-REDIS

You should have a Redis server working and configure it or use it the one that it's already coded

If you want to use your Redis server, configure it in index.php file in the lines:

```
const REDIS_PORT = 'PORT';
const REDIS_SERVER = 'REDIS SERVER';
const REDIS_PASSWD = "PASSWORD";
```

Also, set up the url that will return a JSON file in index.php:

```
const URL = 'URL_THAT_WILL_RESPONSE_JSON';
```

Folder content:

- index.php: The main file of the solution. It's possible to setup the Redis Server and URL that will be called
- json_response.php: This page response a JSON
- classes/RedisScope.php: Class file that encapsules a simple PHP Redis solution to set and get cache
- classes/SimpleJsonRequest.php: Class file that will make the request.

# JavaScript

Just run the files and get the results

Folder content:

- index.html: Show the answer formated, for each element created, as:
  x second ago
  x minute ago
  x hour ago
  begin date

# CSS

Just run the file and get the result

Folder content:
- index.html: Web page to show the formated page as the challenge asks for
- style.css: Stylesheet file used in the page. It uses BEM.


