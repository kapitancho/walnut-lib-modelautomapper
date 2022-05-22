<?php

namespace Walnut\Lib\ModelAutoMapper\Builder;

use Walnut\Lib\DataType\Exception\InvalidValue;
use Walnut\Lib\DataType\Importer\ClassHydrator;
use Walnut\Lib\ModelMapper\ModelBuilder;

/**
 * @template T of object
 * @implements ModelBuilder<T>
 */
final class OpenApiModelBuilder implements ModelBuilder {
	/**
	 * @param ClassHydrator $classHydrator
	 * @param class-string<T> $className
	 */
	public function __construct(
		private readonly ClassHydrator $classHydrator,
		private readonly string $className
	) {}

	/**
	 * @param array $source
	 * @return T
	 * @throws InvalidValue
	 */
	public function build(array $source): object {
		return $this->classHydrator->importValue($source, $this->className);
	}
}
