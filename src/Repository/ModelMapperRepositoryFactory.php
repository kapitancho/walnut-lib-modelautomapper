<?php

namespace Walnut\Lib\ModelAutoMapper\Repository;

use Walnut\Lib\ModelMapper\ModelIdentityGeneratorFactory;
use Walnut\Lib\ModelMapper\ModelMapperFactory;

final class ModelMapperRepositoryFactory {
	public function __construct(
		private readonly ModelMapperFactory $modelMapperFactory,
		private readonly ModelIdentityGeneratorFactory $identityGeneratorFactory
	) {}

	/**
	 * @template T
	 * @param class-string<T> $model
	 * @return ModelMapperRepository<T>
	 */
	public function getRepository(string $model): ModelMapperRepository {
		return new ModelMapperRepository(
			$this->modelMapperFactory->getMapper($model),
			$this->identityGeneratorFactory->getIdentityGenerator($model)
		);
	}
}
