<?php


namespace Kntnt\Schedule_Social_Media;


trait WPML {

    private $lang;

    private function init_lang( $post_id = null ) {
        if ( $post_id ) {
            if ( ( $language_details = apply_filters( 'wpml_post_language_details', null, $post_id ) ) && isset( $language_details ) && isset( $language_details['language_code'] ) ) {
                $this->lang = $language_details['language_code'];
            }
            else {
                $this->lang = '';
            }
        }
        else {
            $this->lang = apply_filters( 'wpml_current_language', null ) ?: '';
        }
    }

    private function webhook_name( $taget ) {
        return "{$taget}_{$this->lang}_webhook";
    }

    private function webhook( $taget ) {
        return Plugin::option( $this->webhook_name( $taget ), false );
    }

    private function url( $url ) {
        if ( $this->lang ) {
            return apply_filters( 'wpml_permalink', $url, $this->lang, true );
        }
        return $url;
    }

}