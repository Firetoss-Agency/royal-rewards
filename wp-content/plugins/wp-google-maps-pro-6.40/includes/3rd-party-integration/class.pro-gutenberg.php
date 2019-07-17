<?php

namespace WPGMZA\Integration;

if(defined('WPGMAPS_DIR') && file_exists(WPGMAPS_DIR . 'includes/3rd-party-integration/class.gutenberg.php'))
	require_once(WPGMAPS_DIR . 'includes/3rd-party-integration/class.gutenberg.php');

if(!class_exists('WPGMZA\\Integration\\Gutenberg'))
	return;

class ProGutenberg extends Gutenberg
{
	public function __construct()
	{
		Gutenberg::__construct();
		
		add_filter('wpgmza_plugin_get_localized_data', array(
			$this,
			'onPluginGetLocalizedData'
		));
	}
	
	public function onEnqueueBlockAssets()
	{
		global $wpgmza;
		
		Gutenberg::onEnqueueBlockAssets();
		
		if(!is_admin())
			return;
		
		$url = plugin_dir_url(WPGMZA_PRO_FILE) . 'js/v8/3rd-party-integration/gutenberg/dist/pro-gutenberg.js';
		
		wp_enqueue_script('wpgmza-v6-pro-gutenberg', $url, array(), $wpgmza->getBasicVersion());
	}
	
	public function onPluginGetLocalizedData($data)
	{
		global $wpdb;
		global $WPGMZA_TABLE_NAME_MAPS;
		
		// TODO: Add deleted column, active = 0 is misleading. Deprecate this column
		$maps = $wpdb->get_results("SELECT id, map_title FROM $WPGMZA_TABLE_NAME_MAPS WHERE active = 0");
		
		$data['gutenbergData'] = array(
			'maps' => $maps
		);
		
		return $data;
	}
	
	public function onRender($attr)
	{
		global $wpdb;
		global $WPGMZA_TABLE_NAME_MAPS;
		
		extract($attr);
		
		$mapID = '1';
		
		if(isset($attr['id']))
			$mapID = $attr['id'];
		else
			$mapID = $wpdb->get_var("SELECT id FROM $WPGMZA_TABLE_NAME_MAPS LIMIT 1");
		
		$output_attributes = array(
			'id' => $mapID
		);
		
		if(!empty($attr['mashup_ids']))
		{
			$mashup_ids = $attr['mashup_ids'];
			
			// Main ID isn't implicitly included, so include it here if it's not present already
			if(array_search($mapID, $mashup_ids) === false)
				$mashup_ids[] = $mapID;
			
			$output_attributes['mashup']		= 'true';
			$output_attributes['mashup_ids']	= implode(',', $mashup_ids);
			$output_attributes['parent_id']		= $mapID;
		}
		
		$attributes_string = '';
		
		foreach($output_attributes as $key => $value)
		{
			$attributes_string .= " {$key}=\"" . addslashes($value) . "\"";
		}
		
		$string = "[wpgmza{$attributes_string}]";
		
		return $string;
	}
}

add_filter('wpgmza_create_WPGMZA\\Integration\\Gutenberg', function($input) {
	
	return new ProGutenberg();
	
}, 10, 1);
