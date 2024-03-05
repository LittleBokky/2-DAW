<?php

namespace App\Controller;

use App\Entity\Producto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarritoController extends AbstractController
{
    #[Route('/add_to_cart', name: 'app_add_to_cart', methods: ['POST'])]
    public function addToCart(Request $request): Response
    {
        // Obtener el ID del producto desde la solicitud
        $productoId = $request->request->get('producto_id');

        // Obtener la sesión
        $session = $request->getSession();

        // Obtener o inicializar el carrito en la sesión
        $carrito = $session->get('carrito', []);

        // Verificar si el producto ya está en el carrito
        if (!in_array($productoId, $carrito)) {
            // Agregar el producto al carrito
            $carrito[] = $productoId;
            $session->set('carrito', $carrito);
        }

        // Redirigir al carrito
        return $this->redirectToRoute('app_carrito');
    }

    #[Route('/carrito', name: 'app_carrito')]
    public function index(Request $request, \Doctrine\ORM\EntityManagerInterface $entityManager): Response
    {
        // Obtener la sesión
        $session = $request->getSession();

        // Obtener el carrito de la sesión
        $carrito = $session->get('carrito', []);

        // Obtener los detalles de los productos en el carrito
        $productos = [];
        foreach ($carrito as $productoId) {
            // Buscar el producto en la base de datos por su ID
            $producto = $entityManager->getRepository(Producto::class)->find($productoId);
            
            // Si el producto existe, agrégalo a la lista de productos
            if ($producto !== null) {
                $productos[] = $producto;
            }
        }

        return $this->render('carrito/index.html.twig', [
            'controller_name' => 'CarritoController',
            'productos' => $productos,
        ]);
    }

    #[Route('/eliminar_del_carrito/{id}', name: 'app_eliminar_del_carrito')]
    public function eliminarDelCarrito(Request $request, $id): Response
    {
        // Obtener la sesión
        $session = $request->getSession();

        // Obtener el carrito de la sesión
        $carrito = $session->get('carrito', []);

        // Buscar el índice del producto en el carrito
        $index = array_search($id, $carrito);

        // Si se encuentra el producto en el carrito, eliminarlo
        if ($index !== false) {
            unset($carrito[$index]);
            $session->set('carrito', $carrito);
        }

        // Redirigir al carrito
        return $this->redirectToRoute('app_carrito');
    }
}
