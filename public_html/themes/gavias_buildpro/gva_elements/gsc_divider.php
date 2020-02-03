<?php 
namespace Drupal\gavias_blockbuilder\shortcodes;
if(!class_exists('gsc_divider')):
  class gsc_divider{
    
     public function render_form(){
        $fields = array(
           'type'  => 'gsc_divider',
           'title' => ('Divider'), 
           'size'  => 12,
           'fields'   => array(
              array(
                'id'        => 'type',
                'title'     => t('Style'),
                'type'      => 'select',
                'options'   => array(
                  'one-line'          => '1 line',
                  'two-line'          => '2 line',
                  'three-line'        => '3 line'
                ),
              ),
              array(
                  'id'        => 'el_class',
                  'type'      => 'text',
                  'title'     => t('Extra class name'),
                  'desc'      => t('Style particular content element differently - add a class name and refer to it in custom CSS.'),
               ),
           ),                                       
        );
      return $fields;
    }

    public function render_content( $item ) {
       print self::sc_divider( $item['fields'] );
    }

    public static function sc_divider( $attr, $content = null ){
      extract(shortcode_atts(array(
        'type'       => 'one-line',
        'el_class'   => '' 
      ), $attr));
      $el_class .= ' ' . $type;
      ?>
      <?php ob_start() ?>
        <div class="widget clearfix gsc-divider <?php print $el_class ?>"><div class="line-1"></div><div class="line-2"></div><div class="line-3"></div></div>
        <?php return ob_get_clean() ?>    
      <?php 
     }

     public function load_shortcode(){
      add_shortcode( 'divider', 'gsc_divider', 'sc_divider' );
     }
  }
endif;  



