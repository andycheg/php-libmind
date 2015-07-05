<?php
namespace PhpLibMind\Tests\EasyMind;


use PhpLibMind\Document;
use PhpLibMind\EasyMind\Exporter;
use PhpLibMind\Topic;

class ExportTest extends \PHPUnit_Framework_TestCase {

	public function testSimpleMap()
	{
		$created = "143513451";
		$rootTopic = new Topic("Central", $created);
		$subTopicA = new Topic("A", $created);
		$subTopicB = new Topic("B", $created);
		$rootTopic->addSub($subTopicA);
		$rootTopic->addSub($subTopicB);
		$doc = new Document("Document1", $rootTopic, $created);

		$json = (new Exporter())->export($doc);
		//file_put_contents(__DIR__."/expected.json", $json);
		$this->assertJsonStringEqualsJsonFile(__DIR__."/expected.json", $json);
	}
}