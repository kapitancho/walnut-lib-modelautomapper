<?php

namespace Walnut\Lib\ModelAutoMapper\Repository;

use Walnut\Lib\IdentityGenerator\IdentityGenerator;
use Walnut\Lib\ModelMapper\ModelMapper;

/**
 * @template T of object
 */
final class ModelMapperRepository {
	/**
	 * @param ModelMapper<T> $modelMapper
	 * @param IdentityGenerator $identityGenerator
	 */
	public function __construct(
		private /*readonly*/ ModelMapper $modelMapper,
		private /*readonly*/ IdentityGenerator $identityGenerator
	) {}

	/**
	 * @return T[]
	 */
	public function all(): array {
		return $this->modelMapper->all();
	}
	/**
	 * @param string $entryId
	 * @return T|null
	 */
	public function byId(string $entryId): ?object {
		return $this->modelMapper->byId($entryId);
	}
	/**
	 * @param string $entryId
	 * @param T $entry
	 */
	public function store(string $entryId, object $entry): void {
		$this->modelMapper->store($entryId, $entry);
	}
	public function remove(string $entryId): void {
		$this->modelMapper->remove($entryId);
	}
	public function generateEntryId(): string {
		return $this->identityGenerator->generateId();
	}
}
