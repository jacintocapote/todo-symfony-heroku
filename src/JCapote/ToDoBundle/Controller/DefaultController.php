<?php

namespace JCapote\ToDoBundle\Controller;

use JCapote\ToDoBundle\Entity\Item;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $item_list = $this->getAllToDoItems();

        $item = new Item;
      
        $form = $this->createFormBuilder($item)
        ->add('text', TextareaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('Save', SubmitType::class, array('label'=> 'Add Item', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
        ->getForm();
        
        /*$form->handleRequest($request);
        if($form->isSubmitted() &&  $form->isValid()){
            $id = 3;
            $text = $form['text']->getData();
            
            $item->setId($name);
            $item->setText($text);          
            $item->setStatus(FALSE);                  
            
            $sn = $this->getDoctrine()->getManager();      
            $sn -> persist($item);
            $sn -> flush();
            
            $this->addFlash(
                'notice',
                'Item Added'
            );
            return $this->redirectToRoute('todo_list');
        }*/
 

        return $this->render('JcapoteToDoBundle:Default:index.html.twig', array(
            'item_list' => $item_list,
            'form' => $form->createView(),
        ));
    }

    private function getAllToDoItems()
    {
        $items = $this->getDoctrine()
          ->getRepository('JCapote\ToDoBundle\Entity\Item')
          ->findAll();

        return $items;
    }
}
