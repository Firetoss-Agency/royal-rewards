"use strict";

/**
 * @namespace WPGMZA.Integration
 * @module ProGutenberg
 * @requires WPGMZA.Gutenberg
 */

/**
 * Internal block libraries
 */
jQuery(function ($) {

	if (!window.wp || !wp.i18n || !wp.blocks || !wp.editor) return;

	var __ = wp.i18n.__;
	var registerBlockType = wp.blocks.registerBlockType;
	var _wp$editor = wp.editor,
	    InspectorControls = _wp$editor.InspectorControls,
	    BlockControls = _wp$editor.BlockControls;
	var _wp$components = wp.components,
	    Dashicon = _wp$components.Dashicon,
	    Toolbar = _wp$components.Toolbar,
	    Button = _wp$components.Button,
	    Tooltip = _wp$components.Tooltip,
	    PanelBody = _wp$components.PanelBody,
	    TextareaControl = _wp$components.TextareaControl,
	    TextControl = _wp$components.TextControl,
	    RichText = _wp$components.RichText,
	    SelectControl = _wp$components.SelectControl;

	WPGMZA.Integration.ProGutenberg = function () {
		WPGMZA.Integration.Gutenberg.call(this);
	};

	WPGMZA.Integration.ProGutenberg.prototype = Object.create(WPGMZA.Integration.Gutenberg.prototype);
	WPGMZA.Integration.ProGutenberg.prototype.constructor = WPGMZA.Integration.ProGutenberg;

	WPGMZA.Integration.Gutenberg.getConstructor = function () {
		return WPGMZA.Integration.ProGutenberg;
	};

	WPGMZA.Integration.ProGutenberg.prototype.getMapSelectOptions = function () {
		var result = [];

		WPGMZA.gutenbergData.maps.forEach(function (el) {

			result.push({
				value: el.id,
				label: el.map_title + " (" + el.id + ")"
			});
		});

		return result;
	};

	WPGMZA.Integration.ProGutenberg.prototype.getBlockInspectorControls = function (props) {
		var onChangeMap = function onChangeMap(value) {
			props.setAttributes({ id: value });
		};

		var onChangeMashupIDs = function onChangeMashupIDs(value) {
			props.setAttributes({ mashup_ids: value });
		};

		var onEditMap = function onEditMap(event) {

			var select = $("select[name='map_id']");
			var map_id = select.val();

			window.open(WPGMZA.adminurl + "admin.php?page=wp-google-maps-menu&action=edit&map_id=" + map_id);

			event.preventDefault();
			return false;
		};

		var selectedMapID = "1";

		if (props.attributes.id) selectedMapID = props.attributes.id;else if (WPGMZA.gutenbergData.maps.length) selectedMapID = WPGMZA.gutenbergData.maps[0].id;

		return React.createElement(
			InspectorControls,
			{ key: "inspector" },
			React.createElement(
				PanelBody,
				{ title: __('Map Settings') },
				React.createElement(SelectControl, {
					name: "map_id",
					label: __("Map"),
					value: selectedMapID,
					options: this.getMapSelectOptions(),
					onChange: onChangeMap
				}),
				React.createElement(SelectControl, {
					label: __("Mashup IDs"),
					value: props.attributes.mashup_ids || [],
					options: this.getMapSelectOptions(),
					multiple: true,
					onChange: onChangeMashupIDs
				}),
				React.createElement(
					"p",
					{ "class": "map-block-gutenberg-button-container" },
					React.createElement(
						"a",
						{ href: WPGMZA.adminurl + "admin.php?page=wp-google-maps-menu",
							onClick: onEditMap,
							target: "_blank",
							"class": "button button-primary" },
						React.createElement("i", { "class": "fa fa-pencil-square-o", "aria-hidden": "true" }),
						__('Go to Map Editor')
					)
				),
				React.createElement(
					"p",
					{ "class": "map-block-gutenberg-button-container" },
					React.createElement(
						"a",
						{ href: "https://www.wpgmaps.com/documentation/creating-your-first-map/",
							target: "_blank",
							"class": "button button-primary" },
						React.createElement("i", { "class": "fa fa-book", "aria-hidden": "true" }),
						__('View Documentation')
					)
				)
			)
		);
	};

	WPGMZA.Integration.ProGutenberg.prototype.getBlockAttributes = function (props) {
		return {
			"id": {
				type: "string"
			},
			"mashup_ids": {
				type: "array"
			}
		};
	};

	WPGMZA.Integration.ProGutenberg.prototype.getBlockDefinition = function (props) {
		var definition = WPGMZA.Integration.Gutenberg.prototype.getBlockDefinition.call(this, props);

		return definition;
	};

	WPGMZA.integrationModules.gutenberg = WPGMZA.Integration.Gutenberg.createInstance();
});