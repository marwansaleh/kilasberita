<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of Article
 *
 * @author marwansaleh
 */
class Article extends MY_AdminController {
    function __construct() {
        parent::__construct();
        $this->data['active_menu'] = 'article';
        $this->data['page_title'] = '<i class="fa fa-file-text"></i> Articles';
        $this->data['page_description'] = 'List and update articles';
        
        //Loading model
        $this->load->model(array('article/article_m','article/category_m','article/tags_m','article/global_category_m','article/article_image_m'));
    }
    
    function index(){
        $page = $this->input->get('page', TRUE) ? $this->input->get('page', TRUE):1;
        
        $this->data['page'] = $page;
        $offset = ($page-1) * $this->REC_PER_PAGE;
        $this->data['offset'] = $offset;
        
        $where = NULL;
        
        //count totalRecords
        $this->data['totalRecords'] = $this->article_m->get_count($where);
        //count totalPages
        $this->data['totalPages'] = ceil ($this->data['totalRecords']/$this->REC_PER_PAGE);
        
        $this->data['items'] = array();
        if ($this->data['totalRecords']>0){
            $items = $this->article_m->get_offset('*',$where,$offset,  $this->REC_PER_PAGE);
            if ($items){
                foreach($items as $item){
                    $item->category = $this->category_m->get_value('name',array('id'=>$item->category_id));
                    $item->highlight = strpos($item->types, 'highlight')!==FALSE;
                    $item->slider = strpos($item->types, 'slider')!==FALSE;
                    $this->data['items'][] = $item;
                }
                $url_format = site_url('cms/article/index?page=%i');
                $this->data['pagination'] = smart_paging($this->data['totalPages'], $page, $this->_pagination_adjacent, $url_format, $this->_pagination_pages, array('records'=>count($items),'total'=>$this->data['totalRecords']));
            }
        }
        
        $this->data['pagination_description'] = smart_paging_description($this->data['totalRecords'], count($this->data['items']));
        
        //set breadcumb
        breadcumb_add($this->data['breadcumb'], 'Articles', site_url('cms/article'), TRUE);
        
        $this->data['subview'] = 'cms/article/index';
        $this->load->view('_layout_admin', $this->data);
    }
    
    function edit(){
        $id = $this->input->get('id', TRUE);
        $page = $this->input->get('page', TRUE);
        $this->data['id'] = $id;
        
        if ($id){
            $item = $this->article_m->get($id);
        }else{
            $item = $this->article_m->get_new();
            $item->created = time();
            $item->modified = time();
            $item->created_by = $this->users->get_userid();
            $item->modified_by = $this->users->get_userid();
        }
        //get created by and modified by
        $item->created_by = $this->user_m->get_value('full_name',array('id'=>$item->created_by));
        $item->modified_by = $this->user_m->get_value('full_name',array('id'=>$item->modified_by));
        
        $item->image_list = $item->image_url;
        $item->types = explode('|', $item->types);
        
        if ($item->image_type==IMAGE_TYPE_MULTI){
            $item->multi_images = $this->article_image_m->get_by(array('article_id'=>$id));
            $image_list = array();
            foreach ($item->multi_images as $img){
                $image_list [] = $img->image_url;
            }
            $item->image_list = implode('|', $image_list);
        }
        $this->data['item'] = $item;
        
        //data support
        $this->data['tags'] = array();
        foreach ($this->tags_m->get() as $tag){
            $this->data['tags'] [] = $tag->tag;
        }
        $this->data['categories'] = $this->category_m->get();
        $this->data['article_types'] = $this->global_category_m->get();
        
        //set breadcumb
        breadcumb_add($this->data['breadcumb'], 'Articles', site_url('cms/article/index?page='.$page));
        breadcumb_add($this->data['breadcumb'], 'Update Item', NULL, TRUE);
        
        $this->data['submit_url'] = site_url('cms/article/save?id='.$id.'&page='.$page);
        $this->data['back_url'] = site_url('cms/article/index?page='.$page);
        $this->data['subview'] = 'cms/article/edit';
        $this->load->view('_layout_admin', $this->data);
    }
    
    function save(){
        $id = $this->input->get('id', TRUE);
        $page = $this->input->get('page', TRUE);
        
        $rules = $this->article_m->rules;
        $this->form_validation->set_rules($rules);
        //exit(print_r($rules));
        if ($this->form_validation->run() != FALSE) {
            $postdata = $this->article_m->array_from_post(array('title','url_title','url_short','category_id','date','synopsis','content','image_url','image_type','tags','types','allow_comment','published'));
            
            //convert date string to int
            $postdata['date'] = strtotime($postdata['date']);
            //convert article types to string
            $postdata['types'] = $postdata['types'] ? implode('|', $postdata['types']):'';
            //remove all images from article images table
            if ($id){
                $this->article_image_m->delete_where(array('article_id'=>$id));
            }
            
            //save tags to master tags
            if ($postdata['tags']){
                $tags = explode(',', $postdata['tags']);
                $post_tags = array();
                foreach ($tags as $tag){
                    if ($tag){
                        $post_tags[] = array('tag'=>$tag);
                    }
                }
                
                if (count($post_tags)){
                    $this->tags_m->save_batch($post_tags);
                }
            }
            
            $image_arr = explode('|', $postdata['image_url']);
            
            if ($postdata['image_type']==IMAGE_TYPE_MULTI){
                if (count($image_arr)<2){
                    $postdata['image_type'] = IMAGE_TYPE_SINGLE;
                }
            }
            
            $postdata['image_url'] = isset($image_arr[0])?$image_arr[0]:'';
            
            if (($article_id=$this->article_m->save($postdata, $id))){
                //save articles image if multi
                if ($postdata['image_type']==IMAGE_TYPE_MULTI){
                    $post_images = array();
                    
                    foreach ($image_arr as $img){
                        $post_images [] = array(
                            'article_id'    => $article_id,
                            'image_url'     => $img
                        );
                    }
                    
                    if (count($post_images)){
                        $this->article_image_m->save_batch($post_images);
                    }
                }
                
                $this->session->set_flashdata('message_type','success');
                $this->session->set_flashdata('message', 'Data article item saved successfully');
                
                redirect('cms/article/index?page='.$page);
            }else{
                $this->session->set_flashdata('message_type','error');
                $this->session->set_flashdata('message', $this->article_m->get_last_message());
            }
        }
        
        if (validation_errors()){
            $this->session->set_flashdata('message_type','error');
            $this->session->set_flashdata('message', validation_errors());
        }
        
        redirect('cms/article/edit?id='.$id.'&page='.$page);
    }
    
    function delete(){
        $id = $this->input->get('id', TRUE);
        $page = $this->input->get('page', TRUE);
        
        //check if found data item
        $item = $this->article_m->get($id);
        if (!$item){
            $this->session->set_flashdata('message_type','error');
            $this->session->set_flashdata('message', 'Could not find data article item. Delete item failed!');
        }else{
            if ($this->article_m->delete($id)){
                $this->session->set_flashdata('message_type','success');
                $this->session->set_flashdata('message', 'Data article item deleted successfully');
            }else{
                $this->session->set_flashdata('message_type','error');
                $this->session->set_flashdata('message', $this->article_m->get_last_message());
            }
        }
        
        redirect('cms/article/index?page='.$page);
    }
}

/*
 * file location: engine/application/controllers/cms/article.php
 */
