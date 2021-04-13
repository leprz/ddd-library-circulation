<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\BookCheckOut\Infrastructure;

use Library\Circulation\Common\Application\Exception\EntityNotFoundException;
use Library\Circulation\Common\Infrastructure\Controller\ApiController;
use Library\Circulation\Core\Book\Domain\Error\ItemsLimitExceededErrorException;
use Library\Circulation\Core\LibraryCard\Domain\Error\FinancialRulesViolationErrorException;
use Library\Circulation\Core\LibraryCard\Domain\Error\LibraryMaterialAlreadyBorrowedErrorException;
use Library\Circulation\Core\LibraryMaterial\Domain\Error\LibraryMaterialNotForCheckOutErrorException;
use Library\Circulation\Core\Patron\Infrastructure\PatronIdentityProvider;
use Library\Circulation\UseCase\BookCheckOut\Application\BookCheckOutHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BookCheckOutController extends ApiController
{
    #[Route('book/check-out', methods: ['PUT'])]
    public function index(
        BookCheckOutHandler $handler,
        Request $request,
        PatronIdentityProvider $identityProvider
    ): JsonResponse {
        $contract = new BookCheckOutContract();
        $this->loadDataAndValidateRequestContract($request, $contract);

        try {
            ($handler)(
                $contract->toCommand($identityProvider->getCurrentUser())
            );
        } catch (EntityNotFoundException $e) {
            $this->throwNotFoundHttpException($e);
        } catch (
            ItemsLimitExceededErrorException |
            LibraryMaterialAlreadyBorrowedErrorException |
            FinancialRulesViolationErrorException |
            LibraryMaterialNotForCheckOutErrorException $e
        ) {
            $this->throwBadRequestHttpException($e);
        }

        return new JsonResponse();
    }
}
