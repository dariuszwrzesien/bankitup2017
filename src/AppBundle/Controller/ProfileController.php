<?php

namespace AppBundle\Controller;

use AppBundle\Query\GetUserByIdQuery;

use AppBundle\Query\GetTotalTipsGivenPerMonthForUserIdQuery;
use AppBundle\Query\GetTotalTipsReceivedPerMonthForUserIdQuery;
use AppBundle\Query\GetTipsGivenByUserIdQuery;
use AppBundle\Query\GetTipsReceivedByUserIdQuery;
use Endroid\QrCode\Writer\PngWriter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends AppController
{
    /**
     * @Route("/profile", name="profile_details")
     * @Method("GET")
     * @return JsonResponse
     */
    function detailsAction(): JsonResponse
    {
        $profile = $this->queryDispatcher()->execute(new GetUserByIdQuery(
            $this->auth()->getUserId()
        ));

        return $this->json($profile, Response::HTTP_OK);
    }

    /**
     * @Route("/profile/stats", name="profile_stats")
     * @Method("GET")
     * @return JsonResponse
     */
    public function statsAction(): JsonResponse
    {
        $userId = $this->auth()->getUserId();
        $queryDispatcher = $this->queryDispatcher();

        $stats = [
            'given' => $queryDispatcher->execute(new GetTotalTipsGivenPerMonthForUserIdQuery($userId)),
            'received' => $queryDispatcher->execute(new GetTotalTipsReceivedPerMonthForUserIdQuery($userId))
        ];

        return $this->json($stats, Response::HTTP_OK);
    }

    /**
     * @Route("/profile/tips", name="profile_tips")
     * @Method("GET")
     * @return JsonResponse
     */
    public function tipsAction(): JsonResponse
    {
        $userId = $this->auth()->getUserId();
        $queryDispatcher = $this->queryDispatcher();

        $tips = [
            'given' => $queryDispatcher->execute(new GetTipsGivenByUserIdQuery($userId)),
            'received' => $queryDispatcher->execute(new GetTipsReceivedByUserIdQuery($userId))
        ];

        return $this->json($tips, Response::HTTP_OK);
    }

    /**
     * @Route("/profile/accounts", name="profile_accounts")
     * @Method("GET")
     * @return JsonResponse
     */
    public function accountsAction(): JsonResponse
    {
        $accounts = $this->bankApi()->getAllUserAccounts();

        return $this->json($accounts, Response::HTTP_CREATED);
    }

    /**
     * @Route("/profile/qrcode", name="profile_qrcode")
     * @Method("GET")
     * @return Response
     */
    public function downloadQrCodeAction() : Response
    {
        /**
         * @var $qrCode \Endroid\QrCode\QrCode
         */
        $qrCode = $this->get('endroid.qrcode.factory')->create($this->auth()->getQrCodeText(), [
            'size' => 400
        ]);

        return new Response($qrCode->writeString(PngWriter::class), Response::HTTP_OK, [
            'Content-Type' => $qrCode->getContentType(PngWriter::class)
        ]);
    }
}
