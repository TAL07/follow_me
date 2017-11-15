<?php

namespace FollowMeBundle\Form\Input;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\UrlType;




class Add extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
        ->add("dating_title", TextType::class, [
            "label" => "add.title", 
            "constraints" => [
                new NotBlank([
                    "message" => "add.title.error"
                ])
            ],
            "attr" => [
                "class" => "form-control",
                "placeholder" => "Titre",
                ]
            ])

        ->add("dating_description", TextareaType::class, [
            "label" => "add.description", 
            "constraints" => [
                new NotBlank([
                    "message" => "add.description.error"
                ])
            ],
            "attr" => [
                "class" => "form-control",
                "placeholder" => "description",
                ]
            ])

        ->add("dating_start", DateTimeType::class, [
            "label" => "add.start",
            'format'=> 'yyyy-MM-dd HH:mm',
            "constraints" => [
                new NotBlank([
                    "message" => "add.start.error",
            ])
        ],
            "attr" => [
                "class" => "form-control",
                ]
            ])
        
            ->add("dating_end", TimeType::class, [
                "label" => "add.end",
                
                "constraints" => [
                    new NotBlank([
                        "message" => "add.end.error",
                ])
            ],
                "attr" => [
                    "class" => "form-control",
                   ]
                ])

            ->add("dating_link_href", UrlType::class, [
                "label" => "add.link.href", 
                "constraints" => [
                    new NotBlank([
                        "message" => "add.link.href.error"
                ])
            ],
                "attr" => [
                    "class" => "form-control",
                    ]
                ])

            ->add("dating_link_title", UrlType::class, [
                "label" => "add.link.title", 
                "constraints" => [
                    new NotBlank([
                        "message" => "add.link.title.error"
                ])
            ],
                "attr" => [
                    "class" => "form-control",
                    ]
                ]);

    
     }






}