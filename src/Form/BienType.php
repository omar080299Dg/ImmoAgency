<?php

namespace App\Form;

use App\Entity\Bien;
use App\Entity\Option;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class BienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('prix')
            ->add('description')
            ->add('surface')
            ->add('nbrePiece')
            ->add('nbreChambre')
            ->add('ville')
            ->add('addresse')
            ->add('type',choiceType::class,[
                'choices' =>$this->getChoiceType()
            ])
            ->add('objectif',choiceType::class,[
                'choices' => $this->getChoices()
            ])
            ->add('options',EntityType::class, [
                'class' => Option::class,
                'required' => false,
                'choice_label' => 'name',
                'multiple' => true
            ])
            ->add('imageFile',FileType::class, [
                'required' => false
            ])
            ->add('disponibilite',null,[
                'label' => 'Disponible'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bien::class,
            'translation_domain' => 'forms'
        ]);
    }

    private function getChoices()
    {
        $choices = Bien::OBJECTIF;
        $output=[];
        foreach ($choices as $k => $v){
            $output[$v] = $k;
        }
        return $output;
    }

    private function getChoiceType()
    {
        $types = Bien::TYPE;
        $output=[];
        foreach ($types as $k => $v){
            $output[$v] = $k;
        }
        return $output;
    }
}
