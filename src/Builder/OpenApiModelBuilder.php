<?php

namespace Walnut\Lib\ModelAutoMapper\Builder;

use Walnut\Lib\DataType\Importer\OpenApiImporter;
use Walnut\Lib\ModelMapper\ModelBuilder;

/**
 * @template T of object
 * @implements ModelBuilder<T>
 */
final class OpenApiModelBuilder implements ModelBuilder {
	/**
	 * @param OpenApiImporter $openApiImporter
	 * @param class-string<T> $className
	 */
	public function __construct(
		private readonly OpenApiImporter $openApiImporter,
		private readonly string $className
	) {}

	/**
	 * @param array $source
	 * @return T
	 */
	public function build(array $source): object {
		return $this->openApiImporter->import($source, $this->className);
	}
}
