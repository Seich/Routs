# PHP Routs
It's named that because I can't spell. 

Routs is a small framework for handling PHP routes. It uses a little apache magic and some PHP stuff to work.

For example, if you wanted to have fancy routes for sending pms in your app you could do:
``` php
Rout::get('*/to/*', function($params){
    //send awesome pm stuff.
});
```
The code would be executed on:

    http://example.com/seich/to/steeldragon

You could also use it to have multiple pages:
``` php
Rout::get('*', function($params){
    if($params[0] == 'about') {
        //show my cool about me page.
    }
});
```
In this case any URL would be valid as long as the path was only one level deep.

So, any of these would be valid:

    http://example.com/about
    http://example.com/contact-me

In this case I am using a single function and using conditional statements but, you could also use multiple function calls.
``` php
Rout::get('about', function($params){
    //show about me page
});

Rout::get('contact', function($params){
    //show contact page
});
```
Both of the previous URLs would work.

You can also use the name of a function instead of typing it directly, like this:
``` php
Rout::get('*', 'test_function');

function test_function($params) {
    echo('Hello, World');
}
```