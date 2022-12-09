<?php

namespace App\helpers;

use stdClass;

class Paginator {
    private $_conn;
    private $_limit;
    private $_page;
    private $_query;
    private $_data;
    private $_total;

    public function __construct($data){
        $this->_data = $data;
        $this->_total = count($data);
    }
    public function getData($limit = 10, $page = 1){
        $this->_limit   = $limit;
        $this->_page    = $page;

        $results = [];
        $start = ($this->_page - 1) * $this->_limit;
        $end = $start + $this->_limit;
        $data = $this->_data;
        for ($i = $start; $i < $end; $i++) {
            if (isset($data[$i])) {
                $results[] = $data[$i];
            }
        }

        $result         = new stdClass();
        $result->page   = $this->_page;
        $result->limit  = $this->_limit;
        $result->total  = $this->_total;
        $result->data   = $results;

        return get_object_vars($result);
    }
    public function createLinks( $links, $list_class ) {
        if ( $this->_limit == 'all' ) {
            return '';
        }
        $last       = ceil( $this->_total / $this->_limit );
        $start      = ( ( $this->_page - $links ) > 0 ) ? $this->_page - $links : 1;
        $end        = ( ( $this->_page + $links ) < $last ) ? $this->_page + $links : $last;
        $html       = '<ul class="' . $list_class . '">';
        $class      = ( $this->_page == 1 ) ? "disabled" : "";
        $html       .= '<li class="' . $class . '"><a href="?limit=' . $this->_limit . '&page=' . ( $this->_page - 1 ) . '">&laquo;</a></li>';
        if ( $start > 1 ) {
            $html   .= '<li><a href="?limit=' . $this->_limit . '&page=1">1</a></li>';
            $html   .= '<li class="disabled"><span>...</span></li>';
        }
        for ( $i = $start ; $i <= $end; $i++ ) {
            $class  = ( $this->_page == $i ) ? "active" : "";
            $html   .= '<li class="' . $class . '"><a href="?limit=' . $this->_limit . '&page=' . $i . '">' . $i . '</a></li>';
        }
        if ( $end < $last ) {
            $html   .= '<li class="disabled"><span>...</span></li>';
            $html   .= '<li><a href="?limit=' . $this->_limit . '&page=' . $last . '">' . $last . '</a></li>';
        }
        $class      = ( $this->_page == $last ) ? "disabled" : "";
        $html       .= '<li class="' . $class . '"><a href="?limit=' . $this->_limit . '&page=' . ( $this->_page + 1 ) . '">&raquo;</a></li>';
        $html       .= '</ul>';
        return $html;
    }
}
