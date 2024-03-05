<?php

namespace App\Controller;

use App\Entity\Cancion;
use App\Form\CancionType;
use App\Repository\CancionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/cancion')]
class CancionController extends AbstractController
{
    #[Route('/', name: 'app_cancion_index', methods: ['GET'])]
    public function index(CancionRepository $cancionRepository): Response
    {
        return $this->render('cancion/index.html.twig', [
            'cancions' => $cancionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cancion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cancion = new Cancion();
        $form = $this->createForm(CancionType::class, $cancion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('foto')->getData();
            if ($file !== null) {
                // Generar un nombre único para el archivo
                $fileName = uniqid() . '.' . $file->guessExtension();
                // Almacenar el archivo en una ubicación segura
                $file->move($this->getParameter('images_directory'), $fileName);
                // Guardar el nombre del archivo en la propiedad del usuario
                $cancion->setFoto($fileName);
            }

            $file = $form->get('audio')->getData();
            if ($file !== null) {
                // Generar un nombre único para el archivo
                $fileName = uniqid() . '.mp3';
                // Almacenar el archivo en una ubicación segura
                $file->move($this->getParameter('music_directory'), $fileName);
                // Guardar el nombre del archivo en la propiedad del usuario
                $cancion->setAudio($fileName);
            }

            $entityManager->persist($cancion);
            $entityManager->flush();

            return $this->redirectToRoute('app_cancion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cancion/new.html.twig', [
            'cancion' => $cancion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cancion_show', methods: ['GET'])]
    public function show(Cancion $cancion): Response
    {
        return $this->render('cancion/show.html.twig', [
            'cancion' => $cancion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cancion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cancion $cancion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CancionType::class, $cancion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $file = $form->get('foto')->getData();
            if ($file !== null) {
                // Generar un nombre único para el archivo
                $fileName = uniqid() . '.' . $file->guessExtension();
                // Almacenar el archivo en una ubicación segura
                $file->move($this->getParameter('images_directory'), $fileName);
                // Guardar el nombre del archivo en la propiedad del usuario
                $cancion->setFoto($fileName);
            }

            $file = $form->get('audio')->getData();
            if ($file !== null) {
                // Generar un nombre único para el archivo
                $fileName = uniqid() . '.mp3';
                // Almacenar el archivo en una ubicación segura
                $file->move($this->getParameter('music_directory'), $fileName);
                // Guardar el nombre del archivo en la propiedad del usuario
                $cancion->setAudio($fileName);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_cancion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cancion/edit.html.twig', [
            'cancion' => $cancion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cancion_delete', methods: ['POST'])]
    public function delete(Request $request, Cancion $cancion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cancion->getId(), $request->request->get('_token'))) {
            $entityManager->remove($cancion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cancion_index', [], Response::HTTP_SEE_OTHER);
    }
}
