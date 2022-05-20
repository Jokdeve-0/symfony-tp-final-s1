<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/category", name="category_")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("", name="list")
     */
    public function list(Request $request, EntityManagerInterface $entityManager, CategoryRepository $categoryRepository): Response
    {
        $category = new Category();
        $category->setDateCreate(new \DateTime());
        $categoryForm = $this->createForm(CategoryType::class,$category);
        $categoryForm->handleRequest($request);

        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash('success', 'Le catégorie à bien été sauvegardée !');
            return $this->redirectToRoute('category_list', ['id' => $category->getId()]);
        }

        $categories = $categoryRepository->findAll();
        return $this->render('category/category.html.twig', [
            "title" => 'Liste des catégories',
            "categories"=>$categories,
            "productForm" => $categoryForm->createView()
        ]);
    }
    /**
     * @Route("/{id}",name="modify",requirements={"id"="\d+"}))
     */
    public function modify(int $id,Request $request, EntityManagerInterface $entityManager, CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findOneBy(['id'=>$id]);
        $categoryForm = $this->createForm(CategoryType::class,$category);
        $categoryForm->handleRequest($request);
        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash('success', 'Le catégorie à bien été Modifiée !');
            return $this->redirectToRoute('category_list', ['id' => $category->getId()]);
        }
        $categories = $categoryRepository->findAll();
        return $this->render('category/category.html.twig', [
            'title' => 'Modifier une catégorie',
            "category"=>$category,
            "categories"=>$categories,
            'productForm'=>$categoryForm->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}",name="delete",requirements={"id"="\d+"}))
     */
    public function delete(int $id, CategoryRepository $categoryRepository): Response
    {
            $category = $categoryRepository->findOneBy(['id'=>$id]);
            if($category !=null ){
                try{
                    $categoryRepository->remove($category,true);
                    $this->addFlash('success', 'La catégorie à bien été supprimée !');
                }catch(\Exception  $e){
                    $this->addFlash('warning', 'Il n\'est pas possible de supprimer cette catégorie car elle est utilisée sur des produits');
                    return $this->redirectToRoute('category_list');
                }
            }
            else{
                $this->addFlash('warning', 'La catégorie n\'existe pas');
            }
        return $this->redirectToRoute('category_list');
    }


}
