<?php


namespace Kntnt\Schedule_Social_Media;


trait Timestamp {

    private function timestamp( $date_and_time ) {
        return \DateTimeImmutable::createFromFormat( 'Y-m-d H:i', $date_and_time, wp_timezone() )->getTimestamp();
    }

}