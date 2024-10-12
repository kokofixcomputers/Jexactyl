<?php

namespace Jexactyl\Http\Controllers\Admin;

use Jexactyl\Models\Node;
use Jexactyl\Models\ApiKey;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Jexactyl\Http\Controllers\Controller;
use Jexactyl\Services\Api\KeyCreationService;
use Illuminate\Contracts\Encryption\Encrypter;
use Jexactyl\Repositories\Eloquent\ApiKeyRepository;

class NodeAutoDeployController extends Controller
{
    /**
     * NodeAutoDeployController constructor.
     */
    public function __construct(
        private ApiKeyRepository $repository,
        private Encrypter $encrypter,
        private KeyCreationService $keyCreationService
    ) {
    }

    /**
     * Generates a new API key for the logged-in user with only permission to read
     * nodes, and returns that as the deployment key for a node.
     *
     * @throws \Jexactyl\Exceptions\Model\DataValidationException
     */
    public function __invoke(Request $request, Node $node): JsonResponse
    {
        /** @var \Jexactyl\Models\ApiKey|null $key */
        $key = $this->repository->getApplicationKeys()
            ->filter(function (ApiKey $key) {
                foreach ($key->getAttributes() as $permission => $value) {
                    if ($permission === 'r_nodes' && $value === 1) {
                        return true;
                    }
                }

                return false;
            })
            ->first();

        // We couldn't find a key that exists for this user with only permission for
        // reading nodes. Go ahead and create it now.
        if (!$key) {
            $key = $this->keyCreationService->setKeyType(ApiKey::TYPE_APPLICATION)->handle([
                'user_id' => $request->user()->id,
                'memo' => 'Automatically generated node deployment key.',
                'allowed_ips' => [],
            ], ['r_nodes' => 1]);
        }

        return new JsonResponse([
            'node' => $node->id,
            'token' => $key->identifier . $this->encrypter->decrypt($key->token),
        ]);
    }
}
