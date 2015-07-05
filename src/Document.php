<?php

namespace PhpLibMind;


class Document {

	private $_rootTopic;
	private $_title;
	private $_created;

	public function __construct ($title, Topic $rootTopic, $created = null)
	{
		$this->_title = $title;
		$this->_rootTopic = $rootTopic;
		$this->_created = $created ?: time();
	}

	/**
	 * @return Topic
	 */
	public function getRootTopic()
	{
		return $this->_rootTopic;
	}

	/**
	 * @param Topic $rootTopic
	 */
	public function setRootTopic($rootTopic)
	{
		$this->_rootTopic = $rootTopic;
	}

	/**
	 * @return mixed
	 */
	public function getTitle()
	{
		return $this->_title;
	}

	/**
	 * @param mixed $title
	 */
	public function setTitle($title)
	{
		$this->_title = $title;
	}

	/**
	 * @return int
	 */
	public function getCreated()
	{
		return $this->_created;
	}

	/**
	 * @param int $created
	 */
	public function setCreated($created)
	{
		$this->_created = $created;
	}


}