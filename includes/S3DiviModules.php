<?php

class S3DM_S3DiviModules extends DiviExtension {

	public $translationPath;
	/**
	 * The gettext domain for the extension's translations.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $gettext_domain = 's3dm-s3-divi-modules';

	/**
	 * The extension's WP Plugin name.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $name = 's3-divi-modules';

	/**
	 * The extension's version
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $version = '1.3.3';

	/**
	 * S3DM_S3DiviModules constructor.
	 *
	 * @param string $name
	 * @param array  $args
	 */
	public function __construct( $name = 's3-divi-modules', $args = array() ) {
		$this->plugin_dir     = plugin_dir_path(  __FILE__ );
		$this->plugin_dir_url = plugin_dir_url( $this->plugin_dir );
		$this->translationPath = plugin_dir_path( dirname(__FILE__) );
		load_plugin_textdomain( $this->gettext_domain, false, basename( $this->translationPath ) . '/languages' );

		parent::__construct( $name, $args );
	}
	
}

new S3DM_S3DiviModules;
