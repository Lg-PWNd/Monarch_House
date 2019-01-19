<?php

class IWJ_Admin_Level {
	static public function init(){
		if(!iwj_option('disable_level')){
            new IWJ_Admin_Radiotax('iwj_level', 'iwj_job');
            //new IWJ_Admin_Radiotax('iwj_level', 'iwj_candidate');
		}
    }
}

IWJ_Admin_Level::init();
?>
