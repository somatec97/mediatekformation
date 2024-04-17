<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Formation;
use DateTime;
use App\Entity\Playlist;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('publishedAt', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date',
                'data' => isset($options['data']) && $options['data']->getPublishedAt() !=null ? $options['data']->getPublishedAt() :new dateTime(),
                'required' => true
            ])
            ->add('title', TextType::class, [
                'label' => 'formation',
                'required' => true
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => false
            ])
            ->add('videoId')
            ->add('playlist', EntityType::class, [
                'class' => Playlist::class,
                'choice_label' => 'name',
                'multiple' => false,
                'required' => true 
            ])
            ->add('categories', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'name',
                'multiple' => true,
                'required' => false
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
