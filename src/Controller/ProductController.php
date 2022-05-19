<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product", name="product_")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function list(ProductRepository $productRepo): Response
    {
        $products = $productRepo->findAll();
        return $this->render('product/list.html.twig', [
            'title' => 'Liste des produits',
            "products"=>$products
        ]);
    }
    /**
     * @Route("/detail/{id}",name="detail",requirements={"id"="\d+"}))
     */
    public function detail(int $id,ProductRepository $productRepo): Response
    {
        $product = $productRepo->findOneBy(['id'=>$id]);
        return $this->render('product/detail.html.twig', [
            'title' => 'Detail du produit',
            "product"=>$product
        ]);
    }

    /**
     *  @Route("/create", name="create")
     */
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $product = new Product();
        $product->setDateCreate(new \DateTime());
        $productForm = $this->createForm(ProductType::class,$product);

        $productForm->handleRequest($request);
        if ($productForm->isSubmitted() && $productForm->isValid()) {
            $entityManager->persist($product);
            $entityManager->flush();

            $this->addFlash('success', 'Le produit à bien été sauvegardée !');
            return $this->redirectToRoute('product_detail', ['id' => $product->getId()]);
        }

        return $this->render('product/form.html.twig', [
            "title" => "Détail du produit",
            'productForm' => $productForm->createView()
        ]);
    }

    /**
     * @Route("/modify/{id}",name="modify",requirements={"id"="\d+"}))
     */
    public function modify(int $id,Request $request, EntityManagerInterface $entityManager, ProductRepository $productRepo): Response
    {
        $product = $productRepo->findOneBy(['id'=>$id]);
        $productForm = $this->createForm(ProductType::class,$product);
        $productForm->handleRequest($request);
        if ($productForm->isSubmitted() && $productForm->isValid()) {
            $entityManager->persist($product);
            $entityManager->flush();

            $this->addFlash('success', 'Le produit à bien été Modifié !');
            return $this->redirectToRoute('product_detail', ['id' => $product->getId()]);
        }
        return $this->render('product/form.html.twig', [
            'title' => 'Modifier le produit',
            "product"=>$product,
            'productForm'=>$productForm->createView()
        ]);
    }
    /**
     * @Route("/delete/{id}",name="delete",requirements={"id"="\d+"}))
     */
    public function delete(int $id,Request $request, EntityManagerInterface $entityManager, ProductRepository $productRepo): Response
    {
        $product = $productRepo->findOneBy(['id'=>$id]);
        $productRepo->remove($product,true);
        $this->addFlash('success', 'Le produit à bien été supprimé !');
        return $this->redirectToRoute('product_list', [
            'title' => 'Liste de produit',
        ]);
    }
}
