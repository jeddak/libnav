# libnav

## Overview
A minimalistic, drop-in hierarchical navigation system for a web-based document repository.
Implemented in PHP, HTML, CSS and Javascript.
Built on top of a modified version of Cory LaViska's PHP File Tree ( https://www.abeautifulsite.net/php-file-tree )

---

## Description

Provides a collapsable hierarchical menu tree on the left-hand side of your browser window along with a search function that allows you to pick out directories based on a text search term.

Content is displayed on the right-hand side of the browser.

---

## How To Deploy

### Prerequisites

1. An HTTP server
2. PHP
3. A way of executing PHP via the HTTP server
4. A directory containing documents you wish to access using libnav, accessible to the HTTP server

### Steps

1. place the contents of libnav in the directory containing the documents you want to access
2. Set up an index.php page containing an index iframe and a content iframe:
      `
      <!DOCTYPE html>
      <html>
          <head>
              <title>My Spiffy Document Repository</title>
              <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
              <meta http-equiv="cache-control" content="no-cache" /> 
              <link href="./libnav/css/my_custom.css" rel="stylesheet" type="text/css" media="screen" />
          <script src="./libnav/js/jquery-3.5.1.min.js" type="text/javascript"></script>
          <script src="./libnav/js/php_file_tree.js" type="text/javascript"></script>
        </head>
        <body>
          <table>
            <tr><td>
                <H1> <a href='javascript: openInContentFrame("./libnav/home.html");'>The Repo</a></H1></td>
                <td>
                    <input type="text" id="searchTextField">
                    <button type="button" onclick="javascript: findButtonClick()"  id="searchButton">Search</button>
                    <button type="button" onclick="javascript: resetButtonClick();"  id="resetButton">Reset</button>
                    <button type="button" onclick="javascript: expandAllButtonClick();"  id="expandAllButton">Expand All</button>
                    <button type="button" onclick="javascript: collapseAllButtonClick();"  id="collapseAllButton">Collapse All</button>
                <div id="foundCountDiv" name="foundCountDiv"></div>
              </td>
            </tr>
          </table>
          <iframe title="Index" scrolling="auto" src="./libnav/php/directorylisting.php" id="indexFrame" name="indexFrame"></iframe>
          <iframe title="Content" src="./libnav/home.html" id="contentFrame" name="contentFrame"></iframe>
          <script>
           //handler to execute search when the Enter/Return key is pressed
           document.addEventListener('keypress', function (e) {
               if (e.key === 'Enter') {
                   findButtonClick();
               }
           });
          </script>
        </body>
      </html>
      `
3. Optionally, create custom CSS styles. In the above example, this is  `./libnav/css/my_custom.css`

4. Optionally, Set up a default page to appear in the 'content' iframe.  In the above example, this is  `./libnav/home.html`

**Version 1.0.0**
---
## Contributors

Jonathan Donald <jdonald@treeblossom.com>

---

## License & copyright
This code is licensed under the CC0 1.0 Universal (CC0 1.0) Public Domain Dedication
https://creativecommons.org/publicdomain/zero/1.0/

