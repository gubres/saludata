<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/roles')]
#[IsGranted('ROLE_ADMIN')]
class RolesController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private UserRepository $usuariosRepository;

    public function __construct(EntityManagerInterface $entityManager, UserRepository $usuariosRepository)
    {
        $this->entityManager = $entityManager;
        $this->usuariosRepository = $usuariosRepository;
    }

    #[Route('/', name: 'user', methods: ['GET'])]
    public function verUser(): Response
    {
        return $this->render('roles/index.html.twig');
    }

    #[Route('/data', name: 'user_data', methods: ['GET'])]
    public function userData(Request $request): JsonResponse
    {
        $start = $request->query->getInt('start', 0);
        $length = $request->query->getInt('length', 10);
        $search = $request->query->get('searchValue', '');
        $orderParam = $request->query->all('order');
        $columns = $request->query->all('columns');

        $columnMap = [
            'id' => 'u.id',
            'nombre' => 'u.nombre',
            'email' => 'u.email',
            'estado' => 'u.estado',
            'roles' => 'u.roles'
        ];

        $order = [];
        if (!empty($orderParam)) {
            foreach ($orderParam as $ord) {
                $order[] = [
                    'column' => $columnMap[$columns[$ord['column']]['data']] ?? 'u.id',
                    'dir' => $ord['dir'] ?? 'asc'
                ];
            }
        } else {
            $order[] = ['column' => 'u.id', 'dir' => 'asc'];
        }

        $queryBuilder = $this->usuariosRepository->createQueryBuilder('u')
            ->setFirstResult($start)
            ->setMaxResults($length);

        if (!empty($search)) {
            $queryBuilder->where('u.nombre LIKE :search OR u.email LIKE :search OR u.roles LIKE :search')
                ->setParameter('search', '%' . $search . '%');
        }

        foreach ($order as $ord) {
            $queryBuilder->addOrderBy($ord['column'], $ord['dir']);
        }

        $usuarios = $queryBuilder->getQuery()->getResult();

        $data = array_map(function ($usuario) {
            return [
                'id' => $usuario->getId(),
                'nombre' => $usuario->getNombre(),
                'email' => $usuario->getEmail(),
                'estado' => $usuario->getIsActive(),
                'roles' => implode(', ', $usuario->getRoles()),
                'editar' => '<button type="button" class="btn btn-warning edit-button" data-bs-toggle="modal" data-bs-target="#editModal" data-id="' . $usuario->getId() . '" data-email="' . $usuario->getEmail() . '" data-roles="' . implode(', ', $usuario->getRoles()) . '">Editar</button>',
                'eliminar' => $usuario->getIsActive() ? '<button type="button" class="btn btn-danger delete-button" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="' . $usuario->getId() . '" data-email="' . $usuario->getEmail() . '">Eliminar</button>' : ''
            ];
        }, $usuarios);

        $totalRecords = $this->usuariosRepository->count([]);
        $filteredRecords = $queryBuilder->select('COUNT(u.id)')->getQuery()->getSingleScalarResult();

        return $this->json([
            'draw' => $request->query->getInt('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data
        ]);
    }

    #[Route('/update', name: 'update_user', methods: ['POST'])]
    public function updateUser(Request $request, EntityManagerInterface $entityManager): Response
    {
        $userId = $request->request->get('userId');
        $newRoles = $request->request->all('roles') ?? [];

        $user = $entityManager->getRepository(User::class)->find($userId);
        if ($user) {
            $user->setIsActive(true);
            $user->setEliminado(false);
            $user->setActualizadoEn(new \DateTime("now", new \DateTimeZone('Europe/Madrid'))); // Asignar la fecha actual
            $user->setRoles($newRoles);
            $entityManager->flush();

            return new JsonResponse(['success' => true, 'message' => 'Roles actualizados correctamente.']);
        } else {
            return new JsonResponse(['success' => false, 'message' => 'Usuario no encontrado.']);
        }
    }

    #[Route('/delete', name: 'delete_user', methods: ['POST'])]
    public function deleteUser(Request $request): Response
    {
        $userId = $request->request->get('userId');
        $user = $this->usuariosRepository->find($userId);

        if (!$user) {
            return new JsonResponse(['success' => false, 'message' => 'Usuario no encontrado.']);
        }

        $user->setActualizadoEn(new \DateTime("now", new \DateTimeZone('Europe/Madrid'))); // Asignar la fecha actual
        $user->setEliminado(true); // Marcar el usuario como eliminado
        $user->setIsActive(false); // Marcar el usuario como inactivo

        $this->entityManager->beginTransaction(); // iniciar la transacción 
        try {
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            $this->entityManager->commit(); // commit de la transacción

            return new JsonResponse(['success' => true, 'message' => 'Usuario ha sido marcado como eliminado.']);
        } catch (\Exception $e) {
            $this->entityManager->rollback(); // rollback en la base de datos si en la transacción hay algún error
            return new JsonResponse(['success' => false, 'message' => 'Error al marcar el usuario como eliminado. Error: ' . $e->getMessage()]);
        }
    }
}
