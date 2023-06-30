<?php

namespace App\Controller;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Produto;
use App\Form\ProdutoType;
use App\Repository\ProdutoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;

#[Route('/produto')]
#[ApiResource]
class ControllerProdutoController extends AbstractController
{
    #[Route('/', name: 'produto_index', methods: ['GET'])]
    public function index(ProdutoRepository $produtoRepository): Response
    {
        return $this->render('controller_produto/index.html.twig', [
            'produtos' => $produtoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'produto_new', methods: ['GET', 'POST'])]
    #[Assert\NotBlank]
    public function new(Request $request, ProdutoRepository $produtoRepository): Response
    {

        $produto = new Produto();
        $form = $this->createForm(ProdutoType::class, $produto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produtoRepository->save($produto, true);

            return $this->redirectToRoute('produto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('controller_produto/new.html.twig', [
            'produto' => $produto,
            'form' => $form,
        ]);

        if (empty($name)) {
            throw new \DomainException('O campo de nome é obrigatório');
        }
    }

    #[Route('/{id}', name: 'produto_show', methods: ['GET'])]
    public function show(Produto $produto): Response
    {
        return $this->render('controller_produto/show.html.twig', [
            'produto' => $produto,
        ]);
    }

    #[Route('/{id}/edit', name: 'produto_edit', methods: ['GET', 'POST'])]
    #[Assert\NotBlank]
    public function edit(Request $request, Produto $produto, ProdutoRepository $produtoRepository): Response
    {

        $form = $this->createForm(ProdutoType::class, $produto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produtoRepository->save($produto, true);

            return $this->redirectToRoute('produto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('controller_produto/edit.html.twig', [
            'produto' => $produto,
            'form' => $form,
        ]);

        if (empty($name)) {
            throw new \DomainException('O campo de nome é obrigatório');
        }
    }

    #[Route('/{id}', name: 'produto_delete', methods: ['POST'])]
    public function delete(Request $request, Produto $produto, ProdutoRepository $produtoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produto->getId(), $request->request->get('_token'))) {
            $produtoRepository->remove($produto, true);
        }

        return $this->redirectToRoute('produto_index', [], Response::HTTP_SEE_OTHER);
    }
}
