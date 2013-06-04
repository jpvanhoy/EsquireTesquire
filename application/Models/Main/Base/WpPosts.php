<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Models_Main_WpPosts', 'main');

/**
 * Models_Main_Base_WpPosts
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ID
 * @property integer $post_author
 * @property timestamp $post_date
 * @property timestamp $post_date_gmt
 * @property string $post_content
 * @property string $post_title
 * @property integer $post_category
 * @property string $post_excerpt
 * @property enum $post_status
 * @property enum $comment_status
 * @property enum $ping_status
 * @property string $post_password
 * @property string $post_name
 * @property string $to_ping
 * @property string $pinged
 * @property timestamp $post_modified
 * @property timestamp $post_modified_gmt
 * @property string $post_content_filtered
 * @property integer $post_parent
 * @property string $guid
 * @property integer $menu_order
 * @property string $post_type
 * @property string $post_mime_type
 * @property integer $comment_count
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Main_Base_WpPosts extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('wp_posts');
        $this->hasColumn('ID', 'integer', 8, array(
             'type' => 'integer',
             'length' => 8,
             'fixed' => false,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('post_author', 'integer', 8, array(
             'type' => 'integer',
             'length' => 8,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('post_date', 'timestamp', null, array(
             'type' => 'timestamp',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '0000-00-00 00:00:00',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('post_date_gmt', 'timestamp', null, array(
             'type' => 'timestamp',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '0000-00-00 00:00:00',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('post_content', 'string', null, array(
             'type' => 'string',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('post_title', 'string', null, array(
             'type' => 'string',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('post_category', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('post_excerpt', 'string', null, array(
             'type' => 'string',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('post_status', 'enum', 10, array(
             'type' => 'enum',
             'length' => 10,
             'fixed' => false,
             'unsigned' => false,
             'values' => 
             array(
              0 => 'publish',
              1 => 'draft',
              2 => 'private',
              3 => 'static',
              4 => 'object',
              5 => 'attachment',
              6 => 'inherit',
              7 => 'future',
              8 => 'pending',
             ),
             'primary' => false,
             'default' => 'publish',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('comment_status', 'enum', 15, array(
             'type' => 'enum',
             'length' => 15,
             'fixed' => false,
             'unsigned' => false,
             'values' => 
             array(
              0 => 'open',
              1 => 'closed',
              2 => 'registered_only',
             ),
             'primary' => false,
             'default' => 'open',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('ping_status', 'enum', 6, array(
             'type' => 'enum',
             'length' => 6,
             'fixed' => false,
             'unsigned' => false,
             'values' => 
             array(
              0 => 'open',
              1 => 'closed',
             ),
             'primary' => false,
             'default' => 'open',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('post_password', 'string', 20, array(
             'type' => 'string',
             'length' => 20,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('post_name', 'string', 200, array(
             'type' => 'string',
             'length' => 200,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('to_ping', 'string', null, array(
             'type' => 'string',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('pinged', 'string', null, array(
             'type' => 'string',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('post_modified', 'timestamp', null, array(
             'type' => 'timestamp',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '0000-00-00 00:00:00',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('post_modified_gmt', 'timestamp', null, array(
             'type' => 'timestamp',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '0000-00-00 00:00:00',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('post_content_filtered', 'string', null, array(
             'type' => 'string',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('post_parent', 'integer', 8, array(
             'type' => 'integer',
             'length' => 8,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('guid', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('menu_order', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('post_type', 'string', 20, array(
             'type' => 'string',
             'length' => 20,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => 'post',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('post_mime_type', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('comment_count', 'integer', 8, array(
             'type' => 'integer',
             'length' => 8,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}