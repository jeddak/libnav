<?php
/*

== PHP FILE TREE ==

    Let's call it...oh, say...version 1?

    == AUTHOR ==

        Cory S.N. LaViska
        http://abeautifulsite.net/

        == DOCUMENTATION ==

            For documentation and updates, visit http://abeautifulsite.net/notebook.php?article=21


            additional hacks by JD

            */


           //suppress directories containing implementation files
           $directoryNamesToIgnore = array("libnav",".git");


           final class PhpFileTree {


               /*
               *
               */
              public function should_ignore($directory) {
                  global $directoryNamesToIgnore;
                  $result=(in_array($directory, $directoryNamesToIgnore, true));
                  return $result;
              }


              /*
              *
              */
             public function get_xhtml_file_tree($directory, $return_link, $extensions = array()) {
                 // Generates a valid XHTML list of all directories, sub-directories, and files in $directory
                 // Remove trailing slash
                 if( substr($directory, -1) == "/" ) {
                     $directory = substr($directory, 0, strlen($directory) - 1);
                 }
                 $xhtml_buffer .= $this->build_xhtml_file_tree($directory, $return_link, $extensions);
                 return $xhtml_buffer;
             }


             /*
             *
             * Get and sort directories/files.
             * Recursive function called by get_xhtml_file_tree() to list directories/files
             */
            private function build_xhtml_file_tree($directory, $return_link, $extensions = array(), $first_call = true) {
                //console_log($directory);//DEBUG
                //console_log("");//HACK

                if(function_exists("scandir")) {
                    $file = scandir($directory);
                } else {
                    $file = $this->php4_scandir($directory);
                }
                natcasesort($file);
                // Make directories first
                $files = $dirs = array();
                foreach($file as $this_file) {
                    if( is_dir("$directory/$this_file" )) {
                        if( (!$this->should_ignore($this_file))) {
                            $dirs[] = $this_file;
                        }
                    } else {
                        $files[] = $this_file;
                    }
                }
                $file = array_merge($dirs, $files);

                // Filter unwanted extensions
                if( !empty($extensions)) {
                    foreach( array_keys($file) as $key ) {
                        if( !is_dir("$directory/$file[$key]")) {
                            $ext = substr($file[$key], strrpos($file[$key], ".") + 1);
                            if( !in_array($ext, $extensions)) unset($file[$key]);
                        }
                    }

                }
                return $this->generate_xhtml($directory, $file, $first_call, $extensions);
            }



            /*
            *
            */
           private function generate_xhtml($directory, $file, $first_call) {

               $html_output_buffer = "";

               if( count($file) > 2 ) { // Use 2 instead of 0 to account for . and .. "directories"
                   $html_output_buffer = "<ul";
                       if( $first_call ) {
                           $html_output_buffer .= " class=\"php-file-tree\"";
                           $first_call = false;
                       }
                       $html_output_buffer .= ">";
                       foreach( $file as $this_file ) {
                           if( $this_file != "." && $this_file != ".." ) {
                               if( is_dir("$directory/$this_file")) {
                                   $link = str_replace("[link]", "$directory/" . urlencode($this_file), "$directory/" . urlencode($this_file));
                                   $html_output_buffer .= "<li class=\"pft-directory\"><a class=\"toggle\">" . htmlspecialchars($this_file) . "</a>";
                                       $html_output_buffer .= "<a href=\"$link/\" target=\"contentFrame\"   > ->  </a>";
                                       //    $html_output_buffer .= $this->build_xhtml_file_tree("$directory/$this_file", $return_link ,$extensions, false);
                                       $html_output_buffer .= $this->build_xhtml_file_tree("$directory/$this_file","" ,$extensions, false);                                       
                                       $html_output_buffer .= "</li>";
                                   }
                               }
                           }
                           $html_output_buffer .= "</ul>";
                       }
                       return $html_output_buffer;
                   }





                   /*
                   * For PHP4 compatibility
                   */
                  private function php4_scandir($dir) {
                      $dh  = opendir($dir);
                      while( false !== ($filename = readdir($dh))) {
                          $files[] = $filename;
                      }
                      sort($files);
                      return($files);
                  }



                  /*  */
                  private function console_log( ...$messages ){
                      $msgs = '';
                      foreach ($messages as $msg) {
                          $msgs .= json_encode($msg);
                      }

                      echo '<script>';
                          echo 'console.log('. json_encode($msgs) .')';
                          echo '</script>';
                      }



                  }



                  // testing
                  //echo (new PhpFileTree())->get_xhtml_file_tree("../../", "null;");
