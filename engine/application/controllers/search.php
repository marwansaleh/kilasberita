<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of Search
 *
 * @author marwansaleh
 */
class Search extends MY_News {
    function __construct() {
        parent::__construct();
        
        $this->data['mainmenus'] = $this->_mainmenu(0); //no submenu
        $this->data['active_menu'] = 'search';
    }
    
    function index(){
        $search_limit = 10;
        
        //Load layout parameters for home page
        $parameters = $this->get_sys_parameters('LAYOUT');
        $this->data['parameters'] = $parameters;
        
        $page = $this->input->get('page', TRUE)?$this->input->get('page', TRUE):1;
        $offset = ($page-1) * $search_limit;
        
        $search = urldecode($this->input->get_post('search', TRUE));
        $this->data['search'] = $search;
        
        $this->data['offset'] = $offset;
        
        //count totalRecords
        $this->data['totalRecords'] = $this->_search_count($search);
        //count totalPages
        $this->data['totalPages'] = ceil ($this->data['totalRecords']/$search_limit);
        
        $this->data['articles'] = array();
        if ($this->data['totalRecords']>0){
            $articles = $this->_search_news($search, $offset, $search_limit);
            
            foreach ($articles as $item){
                $item->created_by_name = $this->user_m->get_value('full_name', array('id'=>$item->created_by));
                $this->data['articles'][] = $item;
            }
            
            $url_format = site_url('search/index?page=%i');
            $this->data['pagination'] = smart_paging($this->data['totalPages'], $page, $this->_pagination_adjacent, $url_format, $this->_pagination_pages, array('records'=>count($articles),'total'=>$this->data['totalRecords']));
        }
        
        $widgets = explode(',',$parameters['LAYOUT_CUSTOM_WIDGETS']);
        $this->data['widgets'] = $widgets;
        if (in_array(WIDGET_NEWSGROUP, $widgets)){
            //Load popular news
            $this->data['popular_news'] = $this->_popular_news(isset($parameters['LAYOUT_NEWSGROUP_NUM'])?$parameters['LAYOUT_NEWSGROUP_NUM']:4);
            //Load popular news
            $this->data['recent_news'] = $this->_latest_news(isset($parameters['LAYOUT_NEWSGROUP_NUM'])?$parameters['LAYOUT_NEWSGROUP_NUM']:4);
            //Load popular news
            $this->data['commented_news'] = $this->_commented_news(isset($parameters['LAYOUT_NEWSGROUP_NUM'])?$parameters['LAYOUT_NEWSGROUP_NUM']:4);
        }
        if (in_array(WIDGET_NEWSLATEST, $widgets)){
            //Load latest post
            $this->data['latest_post'] = $this->_latest_news(isset($parameters['LAYOUT_NEWSLATEST_NUM'])?$parameters['LAYOUT_NEWSLATEST_NUM']:5);
        }
        if (in_array(WIDGET_STOCKS, $widgets)){
            //Load rates
            $this->data['rates'] = $this->_get_rates();
        }
        if (in_array(WIDGET_NEWSPHOTO, $widgets)){
            //store photo news
            $this->data['photo_news'] = $this->_photo_news(isset($parameters['LAYOUT_NEWSPHOTO_NUM'])?$parameters['LAYOUT_NEWSPHOTO_NUM']:10);
        }
        
        $this->data['subview'] = 'frontend/search/index';
        $this->load->view('_layout_main', $this->data);
    }
    
    private function _search_news($search='', $start=0, $num=10){
        $fields = 'id,title, url_title, image_url, image_type, date, synopsis, comment, created_by';
        
        if ($search){
            $this->db->like('title', $search);
            $this->db->or_like('tags', $search);
        }
        return $this->article_m->get_offset($fields, array('published'=>ARTICLE_PUBLISHED),$start,$num);
    }
    
    private function _search_count($search=''){
        if ($search){
            $this->db->like('title', $search);
            $this->db->or_like('tags', $search);
        }
        
        return $this->article_m->get_count(array('published'=>ARTICLE_PUBLISHED));
    }
}

/*
 * file location: engine/application/controllers/home.php
 */
