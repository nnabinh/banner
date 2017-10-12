<?php
class BannerModel extends Model {
    const ALLOWED_IPS = ['10.0.0.1', '10.0.0.2'];
    private $startDate;
    private $endDate;

    //======================================================================
    // Banner list get method
    //======================================================================
    public function Index() {
        // Get user ip address
        $ip = $_SERVER['HTTP_CLIENT_IP']?:($_SERVER['HTTP_X_FORWARDE‌​D_FOR']?:$_SERVER['REMOTE_ADDR']);

        if (in_array($ip, self::ALLOWED_IPS)) {
            // Even before the display period, a banner should be displayed if the user’s device has a specific IP address (allowed IP)
            $this->query('SELECT * FROM banners WHERE DATE(`end_date`) <= CURDATE() ORDER BY create_date DESC');
        } else {
            // A banner should be displayed during its display period
            $this->query('SELECT * FROM banners WHERE DATE(`start_date`) >= CURDATE() AND DATE(`end_date`) <= CURDATE() ORDER BY create_date DESC');
        }
        return $this->resultSet();
    }

    //======================================================================
    // Banner update period method
    //======================================================================
    public function updatePeriod() {
        // The post body should contain 5 values: id, start_date ('DDDD/MM/YY'), start_time('HH:MM'), end_date('DDDD/MM/YY'), end_time('HH:MM')
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if ($post['submit']) {
            // Prepare new data
            $newStartDatetime = new DateTime($post['start_date'].' '.$post['start_time']);
            $newEndDatetime = new DateTime($post['end_date'].' '.$post['end_time']);
            // Insert into MySQL
            $this->query("UPDATE banners SET start_date=:start_date, end_date=:end_date WHERE id=:id");
            $this->bind(':id', $post['id']);
            $this->bind(':start_date', $newStartDatetime->format(DateTime::ATOM)); // Updated ISO8601
            $this->bind(':end_date', $newEndDatetime->format(DateTime::ATOM)); // Updated ISO8601
            $this->execute();
            // Verify
            if ($this->lastxInsertId()) {
                // Redirect
                header('Location: '.ROOT_URL.'banners');
            }
        }
        return;
    }
}
