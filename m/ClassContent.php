<?php

class Content {

    private $template = '';
	private $catname = '';
	private $filename = '';
	private $ext = '';
	private $prefix = '';
	private $out = '';
    
    function __construct( $catname = '', $filename = '', $ext = '', $prefix='' ) 
    {
		global $config;
		$settings = $config->GetSettings( array( 'tpl_dir', 'tpl_parts', 'tpl_ext', 'tpl_prefix' ) );
		
		if ( $catname ) {
			$this->catname = $_SERVER[ 'DOCUMENT_ROOT' ] . '/' . $catname . '/';
		} else { 
			$this->catname = $_SERVER[ 'DOCUMENT_ROOT' ] . '/' . $settings[ 'tpl_dir' ] . '/';
		}
		
		if ( $filename ) {
			$this->filename = $filename;
		} else { 
			$this->filename = $settings[ 'tpl_parts' ];
		}
		
		if ( $prefix ) {
			$this->prefix = $prefix;
		} else { 
			$this->prefix = $settings[ 'tpl_prefix' ];
		}
		
        if ( $ext ) {
			$this->ext = '.' . $ext;
		} else { 
			$this->ext = '.' . $settings[ 'tpl_ext' ];
		}
    }
	
	public function SetContent( $tpl, $tags = array() ) 
	{
		ob_start();
		require_once( $this->catname . $tpl . $this->ext ); 
		$this->template = ob_get_contents();	
		ob_end_clean();
		$this->out = $this->template;
	
		if ( isset( $tags ) ) {
			$this->ReplaceTags( $tags );
		}
		
		return $this->out;
	}
	
	public function SetContentPart( $part, $tags = array() ) 
	{		
		require_once( $this->catname . $this->filename . $this->ext );        
		$parts = get_defined_constants();
		$part = mb_convert_case( $this->prefix . '_' . $part, MB_CASE_UPPER );
       
		if ( $part = $parts[ $part ] ) {
			$this->template = $part;
		}

		$this->out = $this->template;
	
		if ( isset( $tags ) ) {
			$this->ReplaceTags( $tags );
		}
		
		return $this->out;
	}
	
	public function ReplaceTags( $tags ) {
       
        foreach( $tags as $key => $val ) {
            
            $key = mb_convert_case( $key, MB_CASE_UPPER );
            
            if ( strpos( $this->out, '%' . $key . '%' ) ) {
                $this->out = str_replace( '%' . $key . '%', $val, $this->out );
            }
        }
        
        $this->out = preg_replace( '#\%(\w+)\%#', '', $this->out );
		return $this->out;
    }
}
