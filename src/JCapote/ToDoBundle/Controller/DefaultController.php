<?php

namespace JCapote\ToDoBundle\Controller;

use JCapote\ToDoBundle\Entity\Item;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $item_list = $this->getAllToDoItems();

        $item = new Item;
      
        $form = $this->createFormBuilder($item)
        ->add('text', TextareaType::class, array('label' => 'Insert your text', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('Save', SubmitType::class, array('label'=> 'Add Item', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
        ->getForm();
        
        $form->handleRequest($request);
        if($form->isSubmitted() &&  $form->isValid()){
            $text = $form['text']->getData();
            
            $item->setText($text);          
            $item->setStatus(FALSE);                  
            
            $sn = $this->getDoctrine()->getManager();      
            $sn->persist($item);
            $sn->flush();
            
            $this->addFlash(
                'notice',
                'Item was successfull added'
            );
            return new RedirectResponse($this->generateUrl('homepage'));
        }
 

        return $this->render('JcapoteToDoBundle:Default:index.html.twig', array(
            'item_list' => $item_list,
            'form' => $form->createView(),
        ));
    }

    public function completeAction(Request $request, $id) {
        $sn = $this->getDoctrine()->getManager();
        $item = $sn->getRepository('JCapote\ToDoBundle\Entity\Item')->find($id);
        $item->setStatus(TRUE);
        $sn->flush();
            

        $this->addFlash(
            'notice',
            'Item was changed to completed'
        );
        return new RedirectResponse($this->generateUrl('homepage'));
    }

    public function uncompleteAction(Request $request, $id) {
        $sn = $this->getDoctrine()->getManager();
        $item = $sn->getRepository('JCapote\ToDoBundle\Entity\Item')->find($id);
        $item->setStatus(FALSE);
        $sn->flush();


        $this->addFlash(
            'notice',
            'Item was changed to uncompleted'
        );
        return new RedirectResponse($this->generateUrl('homepage'));
    }

    public function deleteAction(Request $request, $id) {
        $sn = $this->getDoctrine()->getManager();
        $item = $sn->getRepository('JCapote\ToDoBundle\Entity\Item')->find($id);
        $sn->remove($item);
        $sn->flush();


        $this->addFlash(
            'notice',
            'Item was removed'
        );
        return new RedirectResponse($this->generateUrl('homepage'));
    }

    private function getAllToDoItems()
    {
        $items = $this->getDoctrine()
          ->getRepository('JCapote\ToDoBundle\Entity\Item')
          ->findAll();

        return $items;
    }
}
