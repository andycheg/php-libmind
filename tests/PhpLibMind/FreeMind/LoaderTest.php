<?php
namespace PhpLibMind\Tests\EasyMind;

use PhpLibMind\FreeMind\Loader;

class LoaderTest extends \PHPUnit_Framework_TestCase {

	public function testSimpleMap()
	{
		$doc = (new Loader())->loadFile(__DIR__."/Fixture/test.mm");
		$this->assertEquals("RootTopic",$doc->getRootTopic()->getTitle());
		$topics = $doc->getRootTopic()->getSubTopics();
		$this->assertEquals("Topic A", $topics[0]->getTitle());
		$this->assertEquals("Topic B", $topics[1]->getTitle());
	}
}