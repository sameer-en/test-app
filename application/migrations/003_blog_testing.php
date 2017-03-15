<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Blog_testing extends CI_Migration {

        public function up()
        {
           $this->db->query("INSERT INTO blogs (`blog_id`, `blog_title`, `blog_description`) VALUES (NULL, 'test title', 'Test description');");
        }

        public function down()
        {
                $this->db->query("Delete from blogs where blog_id=1 limit 1");
        }
}
?>