<?php

use PHPUnit\Framework\TestCase;
use Walnut\Lib\DataType\Importer\OpenApiImporter;
use Walnut\Lib\DataType\Importer\OpenApiReflector;
use Walnut\Lib\IdentityGenerator\IdentityGenerator;
use Walnut\Lib\JsonSerializer\PhpJsonSerializer;
use Walnut\Lib\ModelAutoMapper\Builder\OpenApiModelBuilderFactory;
use Walnut\Lib\ModelAutoMapper\Parser\DefaultModelParserFactory;
use Walnut\Lib\ModelAutoMapper\Repository\ModelMapperRepositoryFactory;
use Walnut\Lib\ModelMapper\ModelIdentityGeneratorFactory;
use Walnut\Lib\ModelMapper\ModelMapper;
use Walnut\Lib\ModelMapper\ModelMapperFactory;

final class ModelMapperRepositoryMock {
	public function __construct(
		public /*readonly*/ int $a,
		public /*readonly*/ string $b
	) {}
}

final class ModelMapperRepositoryTest extends TestCase {

	public function testOk(): void {
		$factory = new ModelMapperRepositoryFactory(
			new class implements ModelMapperFactory {
				public function getMapper(string $className): ModelMapper {
					return new class implements ModelMapper {
						public function all(): array {
							return [];
						}
						public function byCondition(\Walnut\Lib\ModelMapper\ConditionChecker $conditionChecker): array {
							return [];
						}
						public function byId(string $entryId): ?object {
							return new ModelMapperRepositoryMock(strlen($entryId), $entryId);
						}
						public function exists(string $entryId): bool {
							return true;
						}
						public function store(string $entryId, object $entry): void {}
						public function remove(string $entryId): void {}
					};
				}
			},
			new class implements ModelIdentityGeneratorFactory {
				public function getIdentityGenerator(string $className): IdentityGenerator {
					return new class implements IdentityGenerator {
						public function generateId(): string {
							return 'GENERATED-ID';
						}
					};
				}
			}
		);
		$repository = $factory->getRepository(ModelMapperRepositoryMock::class);
		$this->assertEquals([], $repository->all());
		$this->assertEquals(4, $repository->byId('TEST')->a);
		$this->assertEquals('TEST', $repository->byId('TEST')->b);
		$this->assertEquals('GENERATED-ID', $repository->generateEntryId());

		$repository->store('TEST', $repository->byId('TEST'));
		$repository->remove('TEST');
	}

}