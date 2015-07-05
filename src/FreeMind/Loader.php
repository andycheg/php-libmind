<?php
namespace PhpLibMind\FreeMind;

use PhpLibMind\Document;
use PhpLibMind\Topic;

class Loader {

	const DOC_NAME = "Document";

	public function loadFile($fileName)
	{
		$dom = new \DOMDocument();
		$dom->load($fileName);
		return $this->processDom($dom);
	}

	private function processDom(\DOMDocument $dom)
	{
		$xpath = new \DOMXpath($dom);
		$rootNode = $xpath->query("/map/node")->item(0);
		$rootTopic = $this->processNode($rootNode, $xpath);
		return new Document(self::DOC_NAME, $rootTopic);
	}

	private function processNode(\DOMElement $node, \DOMXpath $xpath) {

		$title = $node->getAttribute("TEXT");
		$topic = new Topic($title);

		$childNodes = $xpath->query("./node", $node);
		foreach ($childNodes as $childNode) {
			$subTopic = $this->processNode($childNode, $xpath);
			$topic->addSub($subTopic);
		}

		return $topic;
	}


}