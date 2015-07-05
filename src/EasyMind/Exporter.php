<?php
namespace PhpLibMind\EasyMind;


use PhpLibMind\Document;
use PhpLibMind\Topic;
use PhpLibMind\TopicStyle;

class Exporter {

	const THEME = "default";
	const NOT_DEFINED = "notDefined";
	const DEFAULT_COLLAPSED = false;
	const DEFAULT_TYPE = "attached";
	const BACKGROUND_COLOR = "#FFFFFF";

	public function export(Document $doc)
	{
		$jsonDoc = new \stdClass();
		$jsonDoc->name = $doc->getTitle();
		$jsonDoc->id = $this->generateId("D", $doc->getCreated());
		$jsonDoc->theme = self::THEME;
		$jsonDoc->backgroundColor = self::BACKGROUND_COLOR;
		$jsonDoc->rootTopic = $this->exportTopic($doc->getRootTopic());
		return json_encode($jsonDoc);
	}

	private function exportTopic(Topic $topic)
	{
		$jsonDoc = new \stdClass();
		$jsonDoc->title = $topic->getTitle();
		$jsonDoc->id = $this->generateId("T", $topic->getCreated());
		$jsonDoc->timestamp = $topic->getCreated();

		$jsonDoc->collapsed = self::DEFAULT_COLLAPSED;
		$jsonDoc->image = self::NOT_DEFINED;
		$jsonDoc->hyperlink = self::NOT_DEFINED;
		$jsonDoc->image = self::NOT_DEFINED;
		$jsonDoc->type = self::DEFAULT_TYPE;
		$jsonDoc->markers = new \stdClass();

		$jsonDoc->style = $this->exportStyle($topic->getStyle());

		$jsonDoc->subtopics = [];
		foreach ($topic->getSubTopics() as $subTopic)
			$jsonDoc->subtopics[] = $this->exportTopic($subTopic);

		return $jsonDoc;
	}

	private function exportStyle (TopicStyle $style)
	{
		$jsonDoc = new \stdClass();

		$jsonDoc->topicStructureType = "logchart-right";
		$jsonDoc->strokeType = $this->strokeType($style);

		$jsonDoc->fontColor = self::NOT_DEFINED;
		$jsonDoc->fontSize = self::NOT_DEFINED;
		$jsonDoc->fillColor = self::NOT_DEFINED;
		$jsonDoc->fontStrikeThrought = self::NOT_DEFINED;
		$jsonDoc->fontBold = self::NOT_DEFINED;
		$jsonDoc->strokeColor = self::NOT_DEFINED;
		$jsonDoc->shape = self::NOT_DEFINED;
		$jsonDoc->fontItalic = self::NOT_DEFINED;
		$jsonDoc->strokeWidth = self::NOT_DEFINED;

		return $jsonDoc;
	}

	private function strokeType(TopicStyle $topicStyle)
	{
		switch ($topicStyle->getStrokeType())
		{
			case TopicStyle::STROKE_CURVE:
				return "curve";
			default: return self::NOT_DEFINED;
		}
	}

	private function generateId($prefix, $created)
	{
		return $prefix.$created."_".crc32($created);
	}
}