<?php 
namespace PHPMVC\LIB\Template;

class Template {

    use TemplateHelper;

    private $_templateParts;
    private $_action_view;
    private $_data=[];
    private $_registry;

    public function __construct(array $parts)
    {
        $this->_templateParts=$parts;
    }


    public function setActionViewFile($actionViewPath)
    {
        $this->_action_view = $actionViewPath;
    }


    // these function for data will be passed from the abstract controller
    public function setAppData($data)
    {
        $this->_data=$data;
    }


    public function setRegistry($registry)
    {
        $this->_registry=$registry;
    }

    public function __get($key)
    {
        return $this->_registry->$key;
    }

    private function renderTemplateHeaderStart(){
        require_once TEMPLATE_PATH . 'templateheaderstart.php';
    }



    private function renderBodyStart(){
        require_once TEMPLATE_PATH . 'startbody.php';
    }


    private function renderTemplateFooter(){
        require_once TEMPLATE_PATH . 'templatefooter.php';    
    }

    private function renderNav(){
        require_once TEMPLATE_PATH . 'nav.php';    
    }


    private function renderContent(){
        require_once TEMPLATE_PATH . 'content.php';    
    }


    private function renderTemplateBlocks(){
        if(!array_key_exists('template' , $this->_templateParts)){
            trigger_error('sorry you have to define the template blocks' , E_USER_ERROR);
        }else {
            $parts = $this->_templateParts['template'];
            if(!empty($parts)){
                extract($this->_data);
                foreach($parts as $partKey => $file){
                    if($partKey === ':view'){
                        require_once $this->_action_view;
                    }else{
                        require_once $file;
                    }
                
                }
            }
        }
    }


    private function renderHeaderResources(){
        $output = '';
        if(!array_key_exists('header_resources' , $this->_templateParts)){
            trigger_error('sorry you have to define the header resources' , E_USER_ERROR);
        }else {
            $resources = $this->_templateParts['header_resources'];
            
            // Generate CSS links
            $css = $resources['css'];
            if(!empty($css)){
                foreach($css as $cssKey => $path){
                    $output .= '<link type="text/css" rel="stylesheet" href ="' . $path . '" />';
                }
            }

            // Generate JS Scripts
            // $js = $resources['js'];
            // if(!empty($js)){
            //     foreach($js as $jsKey => $path){
            //         $output .= '<script src="' . $path . '"></script>';
            //     }
            // }
        }
        echo $output;
    }


    private function renderViewResources(){
        $output = '';
        if(!array_key_exists('view_resources' , $this->_templateParts)){
            trigger_error('sorry you have to define the view resources' , E_USER_ERROR);
        }else {
            $resources = $this->_templateParts['view_resources'];

            // Generate CSS links
            $css = $resources['css'];
            if(!empty($css)){
                foreach($css as $cssKey => $path){
                    $output .= '<link type="text/css" rel="stylesheet" href ="' . $path . '" />';
                }
            }


            // $js = $resources['js'];
            // if(!empty($js)){
            //     foreach($js as $jsKey => $path){
            //         $output .= '<script src="' . $path . '"></script>';
            //     }
            // }
        }
        echo $output;
    }


    private function renderFooterResources(){
        $output = '';
        if(!array_key_exists('footer_resources' , $this->_templateParts)){
            trigger_error('sorry you have to define the footer resources' , E_USER_ERROR);
        }else {
            $resources = $this->_templateParts['footer_resources'];

            // $js = $resources['js'];
            // if(!empty($js)){
            //     foreach($js as $jsKey => $path){
            //         $output .= '<script src="' . $path . '"></script>';
            //     }
            // }
        }
        echo $output;
    }


    public function renderApp()
    {
        $this->renderTemplateHeaderStart();
        $this->renderHeaderResources();
        $this->renderViewResources();
        $this->renderNav();
        $this->renderContent();
        $this->renderBodyStart();
        $this->_action_view;
        $this->renderTemplateBlocks();
        $this->renderFooterResources();
        $this->renderTemplateFooter();
    }


}