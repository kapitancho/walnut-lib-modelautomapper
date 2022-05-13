<?php

namespace Walnut\Lib\ModelAutoMapper\Builder;

use Walnut\Lib\DataType\Importer\OpenApiImporter;
use Walnut\Lib\ModelMapper\ModelBuilderFactory;

final class OpenApiModelBuilderFactory implements ModelBuilderFactory {

	/**
	 * @param OpenApiImporter $openApiImporter
	 */
	public function __construct(
		private readonly OpenApiImporter $openApiImporter
	) {}

	/**
	 * @template T
	 * @param class-string<T> $className
	 * @return OpenApiModelBuilder<T>
	 */
	public function getBuilder(string $className): OpenApiModelBuilder {
		return new OpenApiModelBuilder($this->openApiImporter, $className);
	}

}
