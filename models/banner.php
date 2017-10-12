<?php
class BannerModel extends Model {
    public function Index() {
        $this->query('SELECT * FROM banners');
        $rows = $this->resultSet();
        print_r($rows);
    }
}
