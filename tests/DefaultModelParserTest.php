<?php

use PHPUnit\Framework\TestCase;
use Walnut\Lib\DataType\Importer\OpenApiImporter;
use Walnut\Lib\DataType\Importer\OpenApiReflector;
use Walnut\Lib\JsonSerializer\PhpJsonSerializer;
use Walnut\Lib\ModelAutoMapper\Builder\OpenApiModelBuilderFactory;
use Walnut\Lib\ModelAutoMapper\Parser\DefaultModelParserFactory;

final class DefaultModelParserMock {
	public function __construct(
		public /*readonly*/ int $a,
		public /*readonly*/ string $b
	) {}
}

final class DefaultModelParserTest extends TestCase {

	public function testOk(): void {
		$factory = new DefaultModelParserFactory(
			new PhpJsonSerializer
		);
		$parser = $factory->getParser(DefaultModelParserMock::class);
		$result = $parser->parse(new DefaultModelParserMock(1, 'c'));
		$this->assertEquals(1, $result['a']);
		$this->assertEquals('c', $result['b']);
	}

}