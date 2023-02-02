<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;


class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('image', FileType::class, [
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
//                        'mimeTypes' => [
//                            'application/jpg',
//                            'application/png',
//                            'application/jpeg',
//                        ],
                        'mimeTypesMessage' => 'Importez un format en .jpg, .jpeg ou .png',
                    ])
                ],
            ])
            ->add('categories', null, [
                'choice_label' => 'name',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
