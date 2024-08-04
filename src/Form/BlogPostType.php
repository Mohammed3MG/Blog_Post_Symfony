<?php

namespace App\Form;

use App\Entity\Blogs;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class BlogPostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('BlogTitle', TextType::class, [
                'label' => 'Blog Title',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Enter the title of your blog post',
                    'class' => 'data-[size=large]:p-8'
                ]])
            ->add('BlogContent',TextareaType::class)
            ->add('BlogDate', DateType::class,[
                'attr' => [
                    'class' => 'date',
                    'data-size'=>"large",
                ]
             ])
            ->add('BlogImage', FileType::class, [
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Blogs::class,
        ]);
    }
}
