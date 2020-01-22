
<?php


  //@author     Dylan spin

    defined('_JEXEC') or die;
    jimport('joomla.plugin.plugin');

    class PlgSystemtks_popUpKorting extends JPlugin{

        protected $app;
        public $params;

        function __construct(&$subject, $config) {
            parent :: __construct($subject, $config);
        }

        public function createCon($pluginParams){

            $korting = $pluginParams->get('korting');
            $popuptext = $pluginParams->get('popuptext');

            $cont = "<div class='popUpOverlay_Korting' id='popUpKorting' onclick='closekortingblock()'>
                        <div class='popUp_Korting'>
                            <div class='innerPopup_Korting'>
                              <div class='popUpKop_Korting'>50% korting</div>
                            </div>
                        </div>
                    </div>";

      	    return $cont;

      	}

        public function onAfterDispatch(){

            $plugin = JPluginHelper::getPlugin('system', 'tks_kortingPopUp');
            $pluginParams = new JRegistry($plugin->params);

            $plgURL = JURI::base() . 'plugins/system/tks_kortingPopUp';
            $doc = JFactory::getDocument();

            $doc->addStyleSheet($plgURL . '/css/style.css');
            if(!isset($_COOKIE['popUpKorting'])){
                $doc->addScript($plgURL.'/js/javascript.js');
            }

            $this->params = $pluginParams;

        }

        public function onAfterRender(){

            $getapp = JFactory::getApplication();
            $pluginParams = $this->params;
            $body = $this->app->getBody();
            $content = $this->createCon($pluginParams);
            $body = str_replace('</body>', $content . '</body>', $body );

            // if($this->app->isSite()){
                if(!isset($_COOKIE['popUpKorting'])){
                    $this->app->setBody($body);
                }
            // }
            echo "test";

        }

    }

?>
