<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Update_blog extends CI_Migration {

        public function up()
        {
              $this->dbforge->rename_table('blog', 'blogs');
        }

        public function down()
        {
                $this->dbforge->rename_table('blogs', 'blog');
        }
}
?>