<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\AttachmentType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
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

        // https://youtu.be/dKX_yREDOmQ?t=199 




        return  [
            IdField::new('id')->onlyOnIndex(),
            ImageField::new('coverImage')->setBasePath('/images/articles/')->setLabel('Image du produit')->onlyOnIndex(),

            TextField::new('title'),
            TextEditorField::new('description'),
            AssociationField::new('category'),
            AssociationField::new('author'),
            CollectionField::new('images')
                ->setEntryType(AttachmentType::class)
                ->onlyOnForms(),
            MoneyField::new('price')->setCurrency('EUR'),
            ImageField::new('imageFile')->setFormType(VichImageType::class)->onlyOnForms()


        ];
    }

    //TODO: faire les events doctrine au niveau des createdAt
}
