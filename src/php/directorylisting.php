<html>
  <head>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link href="../css/default/default.css" rel="stylesheet" type="text/css" media="screen" />
    <!-- Makes the file tree(s) expand/collapse dynamically -->
    <script src="../js/jquery-3.5.1.min.js" type="text/javascript"></script>
    <script src="../js/php_file_tree.js" type="text/javascript"></script>
  </head>
  <body>
      <?php
      include("./php_file_tree.php");
      echo (new PhpFileTree())->get_xhtml_file_tree("../../", "null;");
      ?>
</body>
</html>
