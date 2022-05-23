<?php

namespace App\Controller;

use App\Entity\Conversation;
use App\Entity\Participant;
use App\Repository\ConversationRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use MongoDB\Driver\ReadConcern;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/conversations", name="conversations.")
 */
class ConversationController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ConversationRepository
     */
    private $conversationRepository;

    public function __contruct(UserRepository $userRepository,
                               EntityManagerInterface $entityManager,
                               ConversationRepository $conversationRepository)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->conversationRepository = $conversationRepository;

    }

    /**
     * @Route("/conversation", name="newConversations", methods ={"POST"})
     * @param Request $request
     * @return Response
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Exception
     */
    public function index(Request $request): Response
    {

        $otherUser = $request->get('otherUser', 0);
        $otherUser = $this->userRepository->find($otherUser);
        if(is_null($otherUser)){
            throw new \Exception("User not found");
        }
        if($otherUser->getId() === $this->getUser()->getId()){
            throw new \Exception("Thats deep but you cant create a conversation with yourself");
        }
        $conversation = $this->conversationRepository->findConversationByParticipants(
            $otherUser->getId(),
            $this->getUser()->getUserIdentifier()
        );

        if(count($conversation)){
            throw new \Exception("The conversation already exists");
        }
        $conversation = new Conversation();

        $participant = new Participant();
        $participant->setUser($this->getUser());
        $participant->setConversation($conversation);

        $otherParticipant = new Participant();
        $otherParticipant->setUser($otherUser);
        $otherParticipant->setConversation($conversation);

        $this->entityManager->getConnection()->beginTransaction();

        try {
            $this->entityManager->persist($conversation);
            $this->entityManager->persist($participant);
            $this->entityManager->persist($otherParticipant);
            $this->entityManager->flush();
            $this->entityManager->commit();

        }
        catch (\Exception $e){
            $this->entityManager->rollback();
            throw $e;
        }
        $this->entityManager->commit();

        return $this->json([
            'id' => $conversation->getId()
        ], Response::HTTP_CREATED, [], []);
    }
    /**
     * @Route("/conversation", name="getConversations", methods ={"POST"})
     *
     */
    public function getConvs(){
        $conversations = $this->conversationRepository->findConversationByUser($this->getUser()->getId());
        dd($conversations);
        return $this->json([

        ]);
    }
}
