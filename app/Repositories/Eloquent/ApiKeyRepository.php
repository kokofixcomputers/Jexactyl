<?php

namespace Jexactyl\Repositories\Eloquent;

use Jexactyl\Models\User;
use Jexactyl\Models\ApiKey;
use Illuminate\Support\Collection;
use Jexactyl\Contracts\Repository\ApiKeyRepositoryInterface;

class ApiKeyRepository extends EloquentRepository implements ApiKeyRepositoryInterface
{
    /**
     * Return the model backing this repository.
     */
    public function model(): string
    {
        return ApiKey::class;
    }

    /**
     * Get all the account API keys that exist for a specific user.
     */
    public function getAccountKeys(User $user): Collection
    {
        return $this->getBuilder()->where('user_id', $user->id)
            ->where('key_type', ApiKey::TYPE_ACCOUNT)
            ->get($this->getColumns());
    }

    /**
     * Get all the application API keys that exist.
     */
    public function getApplicationKeys(): Collection
    {
        return $this->getBuilder()
            ->where('key_type', ApiKey::TYPE_APPLICATION)
            ->get($this->getColumns());
    }

    /**
     * Delete an account API key from the panel for a specific user.
     */
    public function deleteAccountKey(User $user, string $identifier): int
    {
        return $this->getBuilder()->where('user_id', $user->id)
            ->where('key_type', ApiKey::TYPE_ACCOUNT)
            ->where('identifier', $identifier)
            ->delete();
    }

    /**
     * Delete an application API key from the panel.
     */
    public function deleteApplicationKey(string $identifier): int
    {
        return $this->getBuilder()
            ->where('key_type', ApiKey::TYPE_APPLICATION)
            ->where('identifier', $identifier)
            ->delete();
    }
}
