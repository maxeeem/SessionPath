SessionPath
===========

Session-based navigation. Quickly add dynamic functionality using a simple Javascript interface.

The system consists of two parts, a PHP server script and a Javascript file (located in the ``/src`` folder). It helps to think of navigation as transitioning from one state to another, and that is exactly what I tried to capture.

A unique combination of paramenters can be used to identify any state. We store that information in the ``$_SESSION`` variable. When user interaction alters the default state, a Javascript function saves current snapshot in the browser history using ``History API``. It then calls the PHP script to update the current state in the ``$_SESSION`` variable and reloads the page.

The Javascript file also listens to the ``onpopstate`` event which gets triggered when a user clicks the Back button, for example. It uses History API to retrieve a past snapshot and passes it to the PHP script which restores the ``$_SESSION`` to its previous state.

<blockquote>All of this happens in the background and the user never sees any of the information being passed around (as in the case with a URL string). This, along with the ease of deployment (no ``mod_rewrite``, etc.) and implementation, is why I wrote SessionPath and decided to share it, in the hope that other people might find it useful.</blockquote>

===========

In this repository I provided a simple "Hello World"<i>-like</i> example to illustrate the libarary's usage. The dynamic code is in the ``/hello`` folder, and the PHP and JS files are in the ``/ajax`` and ``/js`` folders respectively.

``index.php`` in the ``/`` root folder should be fairly self-explanatory, with just one link to the /hello folder and a line of PHP code for setting our defaults, which in the case of our example is a "Hello World!" exclamation. It is important to note that other line in the very beginning - ``session_start();`` - without which nothing will work :)

``index.php`` in the ``/hello`` folder is our main entry point for this "Hello World" example. Here we see the same ``session_start();`` line as before and then two new lines, importing the Javascript library and setting the path to the PHP script:
```
<script src="../js/sPath.js"></script>
<script type="text/javascript">sPathAJAX('../ajax/sPath.php');</script>
```

The next few lines are just simple logic to display either a "Hello World!" message or one of the custom greetings. Which greeting to display is determined by the onclick event on the links below the text which rely on SessionPath to do the heavy, or as in this example, not so heavy lifting:
```
onclick="sPath('name', 'john');"
```

===========

One more thing that I'd like to note are custom routes.

Here, instead of passing a key-value pair to the ``sPath.js`` function, we passed a single argument:
```
onclick="sPath('example');"
```
This single argument gets picked up by a case switch in the ``sPath.php`` file and can be used to set multiple related variables at once or for doing any other custom logic outside of the scope of simple key-value relationships.
```
switch ($_GET['key']) {
    case 'example':
```
