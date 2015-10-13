<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of Detail
 *
 * @author marwansaleh
 */
class Detail extends MY_News {
    function __construct() {
        parent::__construct();
        
        $this->data['mainmenus'] = $this->_mainmenu(0); //no submenu
        $this->data['active_menu'] = 'home';
        
        //load model
        $this->load->model('article/article_image_m', 'image_m');
    }
    
    function _remap($slug){
        //$this->mobile($slug);
        if ($this->is_device('MOBILE')){
            $this->mobile($slug);
        }else{
            $this->index($slug);
        }
    }
    
    function index($slug=NULL){
        //Load layout parameters for home page
        $parameters = $this->get_sys_parameters('LAYOUT');
        $this->data['parameters'] = $parameters;
        
        //get item
        $article = $this->article_m->get_by(array('url_title'=>$slug), TRUE);
        if (!$article){
            redirect('home');
            exit;
        }
        
        $this->_article_view_counter($article->id);
        
        //Does article has multi images
        if ($article->image_type==IMAGE_TYPE_MULTI){
            //load all images
            $article->images = $this->image_m->get_by(array('article_id'=>$article->id));
        }
        
        //get author name
        $article->created_by_name = $this->user_m->get_value('full_name', array('id'=>$article->created_by));
        
        $this->data['article'] = $article;
        $this->data['related_news'] = $this->_related_news(explode(',',$article->tags), 3, array('id !='=>$article->id));
        
        $widgets = explode(',',$parameters['LAYOUT_DETAIL_WIDGETS']);
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
        
        //$this->data['main_slider'] = TRUE;
        $this->data['subview'] = 'frontend/detail/index';
        $this->load->view('_layout_main', $this->data);
    }
    
    function mobile($slug=NULL){
        //get item
        $article = $this->article_m->get_by(array('url_title'=>$slug), TRUE);
        if (!$article){
            redirect('home');
            exit;
        }
        
        $this->_article_view_counter($article->id);
        
        //get author name
        $article->created_by_name = $this->user_m->get_value('full_name', array('id'=>$article->created_by));
        
        $this->data['article'] = $article;
        $this->data['related_news'] = $this->_related_news(explode(',',$article->tags), 6, array('id !='=>$article->id));
        
        //$this->data['main_slider'] = TRUE;
        $this->data['subview'] = 'mobile/detail/index';
        $this->load->view('_layout_mobile', $this->data);
    }
    
    private function _related_news($tags_array, $num=3, $condition=NULL){
        $limit_each_tag = 10;
        
        if ($tags_array && is_array($tags_array)){
            $current = time();
            $related = array();
            foreach ($tags_array as $tag){
                $this->db->like('tags', $tag);
                $result = $this->article_m->get_offset('id,title,url_title,synopsis,image_url,date',$condition,0,$limit_each_tag);
                
                if ($result){
                    foreach ($result as $r){
                        $related[$current - $r->date] = $r;
                    }
                }
            }
            //now sort by key (the latest)
            ksort($related);
            //create new array for last proccess
            $new_related = array();
            foreach ($related as $r){
                if (count($new_related)<$num){
                    if (!in_array($r->id, $new_related)){
                        $new_related [$r->id] = $r;
                    }
                }
            }
            
            return $new_related;
        }
        
        return NULL;
    }
}

/*
 * file location: engine/application/controllers/detail.php
 */
