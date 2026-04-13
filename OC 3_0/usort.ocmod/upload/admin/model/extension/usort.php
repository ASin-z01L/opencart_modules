<?php

class ModelExtensionUsort extends Model
{
    public function createTable()
    {
        $query = "CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "usort (
          product_id int(11) NOT NULL,
          category_id int(11) NOT NULL,
          sort_cat int(11) NOT NULL DEFAULT 0,
          PRIMARY KEY (product_id, category_id),
          INDEX category_id (category_id)
        )
        
        ENGINE = MYISAM
        DEFAULT CHARSET = utf8";

        $this->db->query($query);
    }

    public function dropTable()
    {
        $query = "DROP TABLE IF EXISTS " . DB_PREFIX . "usort";

        $this->db->query($query);
    }
}