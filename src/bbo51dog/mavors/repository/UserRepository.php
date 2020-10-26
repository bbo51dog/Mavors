<?php

namespace bbo51dog\mavors\repository;

use bbo51dog\mavors\entity\User;

interface UserRepository extends Repository{

    public function exists(string $name): bool;

    public function update(User $user): void;

    public function findByName(string $name): ?User;

    /**
     * @return User[]
     */
    public function getAll(): array;

    public function register(User $user): void;

    public function fetch(string $name): void;
}