<?php

namespace Walnut\Lib\ModelAutoMapper\Parser;

use Walnut\Lib\JsonSerializer\JsonSerializer;
use Walnut\Lib\ModelMapper\ModelParser;
use Walnut\Lib\ModelMapper\ModelParserFactory;

/**
 * @template T of object
 * @implements ModelParser<T>
 */
final class DefaultModelParser implements ModelParser {

	/**
	 * @param JsonSerializer $jsonSerializer
	 */
	public function __construct(
		private /*readonly*/ JsonSerializer $jsonSerializer
	) {}

	/**
	 * @param T $source
	 * @return array
	 */
	public function parse(object $source): array {
		/**
		 * @var array
		 */
		return $this->jsonSerializer->decode($this->jsonSerializer->encode($source), true);
	}
}
