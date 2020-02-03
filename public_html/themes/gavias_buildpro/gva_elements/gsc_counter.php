<?php 
namespace Drupal\gavias_blockbuilder\shortcodes;
if(!class_exists('gsc_counter')):
   class gsc_counter{
      public function render_form(){
         $fields = array(
            'type' => 'gsc_counter',
            'title' => ('Counter'),
            'size' => 3,
            'fields' => array(
               array(
                  'id'        => 'title',
                  'title'     => t('Title'),
                  'type'      => 'text',
                  'class'     => 'display-admin'
               ),
               array(
                  'id'        => 'icon',
                  'title'     => t('Icon'),
                  'type'      => 'text',
                  'std'       => '',
                  'desc'     => t('Use class icon font <a target="_blank" href="http://fontawesome.io/icons/">Icon Awesome</a> or <a target="_blank" href="'.base_path().drupal_get_path('theme', 'gavias_buildpro').'/demo-font/index.html'.'">Custom icon</a>'),
               ),
               array(
                  'id'        => 'image',
                  'type'      => 'upload',
                  'title'     => t('Image Icon'),
                  'desc'      => t('Use image icon instead of icon class'),
               ),
               array(
                  'id'        => 'number',
                  'title'     => t('Number'),
                  'type'      => 'text',
               ),
               array(
                  'id'        => 'type',
                  'title'     => t('Style'),
                  'type'      => 'select',
                  'options'   => array(
                     'icon-left'                => 'Icon left',
                     'icon-top'                 => 'Icon top',
                     'icon-bottom'              => 'Icon Bottom',
                  ),
                  'std'    => 'icon-left',
               ),
               array(
                  'id'        => 'color',
                  'type'      => 'text',
                  'title'     => t('Icon Color'),
                  'desc'      => t('Use color name ( blue ) or hex ( #2991D6 )'),
               ),
               array(
                  'id'        => 'style_text',
                  'type'      => 'select',
                  'title'     => t('Skin Text for box'),
                  'options'   => array(
                     'text-dark'   => 'Text dark',
                     'text-light'   => 'Text light'
                  ),
                  'std'       => 'text-dark'
               ),
               array(
                  'id'        => 'el_class',
                  'type'      => 'text',
                  'title'     => t('Extra class name'),
                  'desc'      => t('Style particular content element differently - add a class name and refer to it in custom CSS.'),
               ),
               array(
                  'id'     => 'animate',
                  'type'      => 'select',
                  'title'  => t('Animation'),
                  'sub_desc'  => t('Entrance animation'),
                  'options'   => gavias_blockbuilder_animate(),
               ),
         
            ),                                      
         );
         return $fields;
      }


      public function render_content( $item ) {
         print self::sc_counter( $item['fields'] );
      }


      public function sc_counter( $attr, $content = null ){
         global $base_url;
         extract(shortcode_atts(array(
            'title'         => '',
            'icon'          => '',
            'image'         => '',
            'number'        => '',
            'type'          => 'icon-top',
            'el_class'      => '',
            'style_text'    => 'text-light',
            'color'         => '',
            'animate'       => '',
         ), $attr));
         if($image) $image = $base_url . $image; 
         $class = array();
         $class[] = $el_class;
         $class[] = 'position-'.$type;
         $class[] = $style_text;
         if($animate){
            $class[] = 'wow';
            $class[] = $animate;
         }
         $style = '';
         if($color) $style = "color: {$color};";
         if($style) $style = 'style="'.$style.'"';
         ?>
         <?php ob_start() ?>
         <div class="widget milestone-block <?php if(count($class) > 0){ print implode($class, ' '); } ?>">
            <?php if($type == 'icon-top' || $type == 'icon-left'){ ?>
               <?php if($icon){ ?><div class="milestone-icon"><span <?php print $style ?> class="<?php print $icon; ?>"></span></div><?php } ?>   
               <?php if($image){ ?><div class="milestone-icon"><img src="<?php print $image ?>"/> </div><?php } ?>
            <?php } ?>
            <div class="milestone-right">
               <div class="milestone-number" <?php print $style ?>><?php print $number; ?></div>
               <div class="milestone-text"><?php print $title ?></div>
            </div>
            <?php if($type == 'icon-bottom'){ ?>
               <?php if($icon){ ?><div class="milestone-icon"><span <?php print $style ?> class="<?php print $icon; ?>"></span></div><?php } ?>   
               <?php if($image){ ?><div class="milestone-icon"><img src="<?php print $image ?>"/> </div><?php } ?>
            <?php } ?>
         </div>
         <?php return ob_get_clean() ?>
         <?php
      }

       public function load_shortcode(){
         add_shortcode( 'counter', array('gsc_counter', 'sc_counter' ));
       }
   }
endif;
   


