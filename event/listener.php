<?php
/**
*
* @package phpBB Extension - Hide foe posts entirely
* @copyright (c) 2016 Captain - http://www.skepticalcommunity.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace captain\cornfieldfoeposts\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	
	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\db\driver\driver */
	protected $db;

	/** @var \phpbb\config\config */
	protected $config;

	/**
	* Constructor
	*
	* @param \phpbb\request\request				$request
	* @param \phpbb\template\template			$template
	* @param \phpbb\user						$user
	* @param \phpbb\db\driver\driver			$db
	* @param \phpbb\config\config				$config
	*/
	public function __construct(\phpbb\request\request $request, \phpbb\template\template $template, \phpbb\user $user, \phpbb\db\driver\driver_interface $db, \phpbb\config\config $config)
	{
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->auth = $auth;
		$this->db = $db;
		$this->config = $config;
	}

    static public function getSubscribedEvents()
    {
        return array(
			'core.user_setup'                   => 'load_user_data',
			'core.ucp_prefs_view_data'          => 'ucp_prefs_get_data',
			'core.ucp_prefs_view_update_data'   => 'ucp_prefs_set_data',
			'core.viewtopic_modify_post_row'    => 'modify_display_options',
        );
    }

	/**
	* Load the necessary data during user setup
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function load_user_data($event)
	{
		// Load the language file
		$lang_set_ext	= $event['lang_set_ext'];
		$lang_set_ext[]	= array(
			'ext_name' => 'captain/cornfieldfoeposts',
			'lang_set' => 'cornfield',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}	
	
	/**
	 * Add user's option state into the sql_array
	 *
	 * @param object $event The event object
	 * @return void
	 */
	public function ucp_prefs_set_data($event)
	{
		$data = $event['data'];
		$event['sql_ary'] = array_merge($event['sql_ary'], array(
			'cornfieldfoeposts' => $data['cornfieldfoeposts'],
		));
	}
	
	/**
	 * Get user's option and display it in UCP Prefs View page
	 *
	 * @param object $event The event object
	 * @return void
	 */
	public function ucp_prefs_get_data($event)
	{
		// Request the user option vars and add them to the data array
		$event['data'] = array_merge($event['data'], array(
			'cornfieldfoeposts'	=> $this->request->variable('cornfieldfoeposts', (bool) $this->user->data['cornfieldfoeposts']),
		));
		// Output the data vars to the template (except on form submit)
		if (!$event['submit'])
		{
			$data = $event['data'];
			//$this->user->add_lang_ext('captain/cornfieldfoeposts', 'cornfieldfoeposts');
			$this->template->assign_vars(array(
				'S_CORNFIELDFOEPOSTS'	=> $data['cornfieldfoeposts'],
			));
		}
	}
	
	public function modify_display_options($event)
	{	
		// Request the user option vars and add them to the data array
		$event['data'] = array('cornfieldfoeposts'	=> $this->request->variable('cornfieldfoeposts', (bool) $this->user->data['cornfieldfoeposts']),
		);
		// Output the data vars to the template (except on form submit)
		if (!$event['submit'])
		{
			$data = $event['data'];
			$this->template->assign_vars(array(
				'S_CORNFIELDFOEPOSTS'	=> $data['cornfieldfoeposts'],
			));
		}
	}
}
