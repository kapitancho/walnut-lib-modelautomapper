<?php

namespace Walnut\Lib\ModelAutoMapper\Builder;

use Walnut\Lib\DataType\Importer\ClassHydrator;
use Walnut\Lib\ModelMapper\ModelBuilderFactory;

final class OpenApiModelBuilderFactory implements ModelBuilderFactory {

	/**
	 * @param ClassHydrator $classHydrator
	 */
	public function __construct(
		private readonly ClassHydrator $classHydrator
	) {}

	/**
	 * @template T
	 * @param class-string<T> $className
	 * @return OpenApiModelBuilder<T>
	 */
	public function getBuilder(string $className): OpenApiModelBuilder {
		return new OpenApiModelBuilder($this->classHydrator, $className);
	}

}
