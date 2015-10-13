<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Tags_m
 *
 * @author Marwan
 * @email amazzura.biz@gmail.com
 */
class Tags_m extends MY_Model {
    protected $_table_name = 'tags';
    protected $_primary_key = 'tag';
    protected $_primary_filter = 'strval';
    protected $_order_by = 'tag';
}

/*
 * file location: /application/models/article/tags_m.php
 */
