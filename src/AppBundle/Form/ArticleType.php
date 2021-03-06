<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ArticleType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('title', TextType::class, ['label' => 'Naziv'])
                ->add('category', TextType::class, ['label' => 'Kategorija'])
                ->add('description', TextType::class, ['label' => 'Opis'])
                ->add('price', NumberType::class, ['label' => 'Cena'])
                ->add('image', TextType::class, ['label' => 'Slika'])
                ->add('Submit', SubmitType::class, ['label' => 'Unesi']);
    }

}
