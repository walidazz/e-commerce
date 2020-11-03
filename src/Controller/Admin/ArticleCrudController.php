<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\AttachmentType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AvatarField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }


    public function configureFields(string $pageName): iterable
    {

        //TODO: mettre en place le template pour la collection d'images https://youtu.be/dKX_yREDOmQ?t=350




        return  [
            IdField::new('id')->onlyOnIndex(),
            ImageField::new('coverImage')->setBasePath('/images/articles/')->setLabel('Image du produit')->onlyOnIndex(),

            TextField::new('title'),
            TextEditorField::new('description'),
            AssociationField::new('category'),
            AssociationField::new('author'),
            CollectionField::new('images')
                ->setEntryType(AttachmentType::class)->setFormTypeOption('by_reference', false)->onlyOnForms(),
            CollectionField::new('images')
                ->setTemplatePath('/images/image.html.twig')
                ->onlyOnDetail(),
            MoneyField::new('price')->setCurrency('EUR'),
            ImageField::new('imageFile')->setFormType(VichImageType::class)->onlyOnForms()


        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            // ...
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    //TODO: faire les events doctrine au niveau des createdAt
}
