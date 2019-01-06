<?php
/**
*
* @package phpBB Extension - Username Colour Changer
* @copyright (c) 2015 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace captain\cornfieldfoeposts\migrations;

class cornfieldfoeposts_schema extends \phpbb\db\migration\migration

{
	public function update_data()
	{
		return array(
			array('config.add', array('cornfieldfoeposts', 0)),
		);
	}

	public function update_schema()
	{
		return array(
			'add_columns'	=> array(
				$this->table_prefix . 'users'	=> array(
					'cornfieldfoeposts'	=> array('BOOL', 0),
				),
			),
		);
	}

	/**
	* Drop the columns schema from the tables
	*
	* @return array Array of table schema
	* @access public
	*/
	public function revert_schema()
	{
		return array(
			'drop_columns'	=> array(
				$this->table_prefix . 'users'	=> array(
					'cornfieldfoeposts',
				),
			),
		);
	}
}
