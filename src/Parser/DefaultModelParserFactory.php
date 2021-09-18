<?php

namespace Walnut\Lib\ModelAutoMapper\Parser;

use Walnut\Lib\JsonSerializer\JsonSerializer;
use Walnut\Lib\ModelMapper\ModelParser;
use Walnut\Lib\ModelMapper\ModelParserFactory;

final class DefaultModelParserFactory implements ModelParserFactory {

	/**
	 * @param JsonSerializer $jsonSerializer
	 */
	public function __construct(
		private /*readonly*/ JsonSerializer $jsonSerializer
	) {}

	/**
	 * @template T of object
	 * @param class-string<T> $className
	 * @return ModelParser<T>
	 */
	public function getParser(string $className): ModelParser {
		/**
		 * @var ModelParser<T>
		 */
		return new DefaultModelParser($this->jsonSerializer);
	}

}
