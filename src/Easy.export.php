<?php


class Doc {

	private $_rootNode;
	public function __construct (Node $a)
	{
		$this->_rootNode = $a;
	}

	public function render()
	{
		$i = new stdClass();
		$i->name = "Document";
		$i->id = "D".time()."_".mt_rand(100000,999999);
		$i->theme = "default";
		$i->backgroundColor = "#FFFFFF";
		$i->rootTopic = $this->_rootNode->render();
		return json_encode($i);
	}	
}
class NodeStyle {

	public function render()
	{
		$i = new stdClass();
		$i->topicStructureType = "logchart-right";
		$i->fontColor = "notDefined";
		$i->fontSize = "notDefined";
		$i->fillColor = "notDefined";
		$i->fontStrikeThrought = "notDefined";
		$i->fontBold = "notDefined";
		$i->strokeColor = "notDefined";
		$i->shape = "notDefined";
		$i->strokeType = "curve";
		$i->fontItalic = "notDefined";
		$i->strokeWidth = "notDefined";
		return $i;
	}	
}

class Node 
{
	private $_title;
	private $_created;
	private $_nodeStyle;

	/**
	 *	@var Node[]
	 */
	private $_subNodes = [];

	public function __construct($title, $created = null)
	{
		$this->_title = $title;
		$this->_created = $created ?: time();
		$this->_nodeStyle = new NodeStyle();
	}

	public function addSub(Node $a)
	{
		$this->_subNodes[] = $a;
	}

	public function render()
	{
		$i = new stdClass();
		$i->subtopics = [];
		$i->title = $this->_title;
		$i->collapsed = false;
		$i->image = "notDefined";
		$i->timestamp = $this->_created;
		$i->hyperlink = "notDefined";
		$i->image = "notDefined";
		$i->id = "T". $this->_created ."-". mt_rand(100000,999999);
		$i->type = "attached";
		$i->markers = new stdClass();
		$i->style = $this->_nodeStyle->render();
		foreach ($this->_subNodes as $node)
			$i->subtopics[] = $node->render();

		return $i;
	}
}

$dom = new DOMDocument();
$dom->load("test.mm");
$xpath = new DOMXpath($dom);
$rootNode = $xpath->query("/map/node")->item(0);
$newNode = processNode($rootNode, $xpath);

function processNode($node, $xpath) {
	$title = $node->getAttribute("TEXT");
	$newNode = new Node($title);
	$childNodes = $xpath->query("./node", $node);
	foreach ($childNodes as $i)
		$newNode->addSub(processNode($i, $xpath));

	return $newNode;
}

$doc = new Doc($newNode);
echo $doc->render();
