<?php

use PHPUnit\Framework\TestCase;
use Walnut\Lib\DataType\Importer\Builder\ReflectionClassDataBuilder;
use Walnut\Lib\DataType\Importer\ClassHydrator;
use Walnut\Lib\DataType\Importer\DefaultClassHydrator;
use Walnut\Lib\DataType\Importer\DefaultImporter;
use Walnut\Lib\ModelAutoMapper\Builder\OpenApiModelBuilderFactory;

final class OpenApiModelBuilderMock {
	public function __construct(
		public /*readonly*/ int $a,
		public /*readonly*/ string $b
	) {}
}

final class OpenApiModelBuilderTest extends TestCase {

	public function testOk(): void {
		$factory = new OpenApiModelBuilderFactory(
			new DefaultClassHydrator(
				new DefaultImporter(
					new ReflectionClassDataBuilder(), ''
				)
			)
		);
		$builder = $factory->getBuilder(OpenApiModelBuilderMock::class);
		$result = $builder->build(['a' => 1, 'b' => 'c']);
		$this->assertEquals(1, $result->a);
		$this->assertEquals('c', $result->b);
	}

}