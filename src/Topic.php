<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 05/07/15
 * Time: 12:33
 */

namespace PhpLibMind;


class Topic {

	/**
	 * @var string Topic title
	 */
	private $_title;

	/**
	 * @var int Timestamp of creation
	 */
	private $_created;

	/**
	 * @var TopicStyle Topic visualization style
	 */
	private $_topicStyle;

	/**
	 *	@var Topic[]
	 */
	private $_subTopics = [];

	/**
	 * @param $title Topic title
	 * @param null $created Creation time
	 */
	public function __construct($title, $created = null)
	{
		$this->_title = $title;
		$this->_created = $created ?: time();
		$this->_topicStyle = new TopicStyle();
	}

	public function addSub(Topic $subTopic)
	{
		$this->_subTopics[] = $subTopic;
	}

	/**
	 * @return int
	 */
	public function getCreated()
	{
		return $this->_created;
	}

	/**
	 * @return TopicStyle
	 */
	public function getStyle()
	{
		return $this->_topicStyle;
	}

	/**
	 * @return Topic[]
	 */
	public function getSubTopics()
	{
		return $this->_subTopics;
	}

	/**
	 * @return string
	 */
	public function getTitle()
	{
		return $this->_title;
	}

}
